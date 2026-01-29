<?php

namespace App\Filament\Resources\AttributeResource\RelationManagers;

use App\Filament\Resources\AttributeResource;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';

    /* ---------------------------------
     | FORM
     |---------------------------------*/
    public function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('code')
            ->label('Code')
            ->required()
            ->maxLength(50),

        Tabs::make('Translations')
            ->tabs(
                collect(AttributeResource::SUPPORTED_LOCALES)
                    ->map(function ($label, $locale) {
                        return Tab::make($label)
                            ->schema([
                                TextInput::make("translations.{$locale}.name")
                                    ->label('Name')
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
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->sortable(),
            ])
            ->actions([
            EditAction::make()
                ->disabled(fn($record) => $record->products()->exists())
                ->fillForm(function ($record) {
                    return [
                        'code' => $record->code,
                        'translations' => $record->translations
                            ->keyBy('locale')
                            ->map(fn($t) => ['name' => $t->name])
                            ->toArray(),
                    ];
                })
                ->using(function ($record, array $data) {

                    // update code
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
   protected function getTableQuery(): Builder
{
    return $this->getOwnerRecord()
        ->values()        // HasMany
        ->getQuery()      // Builder
        ->with('translations');
}
}
