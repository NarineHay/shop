<?php

namespace App\Filament\Resources\AttributeResource\RelationManagers;

use App\Filament\Resources\AttributeResource;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';

    /* ---------------------------------
     | FORM
     |---------------------------------*/
    public function form(Forms\Form $form): Forms\Form
{
    return $form->schema([
        Forms\Components\TextInput::make('code')
            ->label('Code')
            ->required()
            ->maxLength(50),

        Forms\Components\Tabs::make('Translations')
            ->tabs(
                collect(AttributeResource::SUPPORTED_LOCALES)
                    ->map(function ($label, $locale) {
                        return Forms\Components\Tabs\Tab::make($label)
                            ->schema([
                                Forms\Components\TextInput::make("translations.{$locale}.name")
                                    ->label('Name')
                                    ->default(fn ($get, $record) =>
                                        $record->translations->firstWhere('locale', $locale)?->name
                                    )
                                    ->required(),
                            ]);
                    })
                    ->toArray()
            ),
    ]);
}
    /* ---------------------------------
     | TABLE
     |---------------------------------*/
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->sortable(),
            ])
            ->actions([
                EditAction::make()
                    ->disabled(fn ($record) => $record->products()->exists())
                    ->mutateFormDataUsing(fn (array $data, $record) => [
                        ...$data,
                        'translations' => $record->translations
                            ->keyBy('locale')
                            ->map(fn ($t) => ['name' => $t->name])
                            ->toArray(),
                    ])
                    ->using(function ($record, array $data) {
                        // update main code
                        $record->update([
                            'code' => $data['code'],
                        ]);

                        // update translations
                        foreach (AttributeResource::SUPPORTED_LOCALES as $locale => $_) {
                            $name = $data['translations'][$locale]['name'] ?? null;

                            if ($name) {
                                $record->translations()->updateOrCreate(
                                    ['locale' => $locale],
                                    ['name' => $name]
                                );
                            }
                        }

                        return $record;
                    }),

                DeleteAction::make()
                    ->disabled(fn ($record) => $record->products()->exists()),
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (array $data) {
                        $record = $this->getOwnerRecord()
                            ->values()
                            ->create([
                                'code' => $data['code'],
                            ]);

                        foreach (AttributeResource::SUPPORTED_LOCALES as $locale => $_) {
                            $name = $data['translations'][$locale]['name'] ?? null;
                            if ($name) {
                                $record->translations()->create([
                                    'locale' => $locale,
                                    'name'   => $name,
                                ]);
                            }
                        }

                        return $record;
                    }),
            ]);
    }

    /* ---------------------------------
     | QUERY
     |---------------------------------*/
   protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
{
    return $this->getOwnerRecord()
        ->values()        // HasMany
        ->getQuery()      // Builder
        ->with('translations');
}
}
