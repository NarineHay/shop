<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Filament\Resources\PortfolioResource\RelationManagers\ImagesRelationManager;
use App\Filament\Traits\DynamicFilterTrait;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\{Group, Select, Tabs, TextInput, Textarea, Toggle};
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\{TextColumn, ToggleColumn};
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class PortfolioResource extends Resource
{
    use DynamicFilterTrait;
    protected static ?string $model = Portfolio::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([

                Toggle::make('active')->label('Ակտիվ')->default(true),

                Tabs::make('Translations')->tabs([
                    self::langTab('ru', 'Русский'),
                    self::langTab('hy', 'Հայերեն'),
                    self::langTab('en', 'English'),
                ]),
            ]),
        ]);
    }

    protected static function langTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("translations.{$locale}.name")
                ->label('Անվանում')
                ->required()
                ->default(fn($record) => $record?->translation($locale)?->name),

            TextInput::make("translations.{$locale}.slug")
                ->label('Slug')
                ->required()
                ->rule(function ($record) use ($locale) {
                    $translationId = $record?->translations
                        ?->firstWhere('locale', $locale)
                        ?->id;

                    $rule = Rule::unique('portfolio_translations', 'slug')
                        ->where(fn ($query) => $query->where('locale', $locale));

                    if ($translationId) {
                        $rule->ignore($translationId);
                    }

                    return $rule;
                }),
                // ->default(fn($record) => $record?->translation($locale)?->slug),


            Textarea::make("translations.{$locale}.description")
                ->label('Նկարագրություն')
                ->required()
                ->rows(4)
                ->default(fn($record) => $record?->translation($locale)?->description),

            Textarea::make("translations.{$locale}.technologies")
                ->label('Տեխնոլոգիաներ')
                ->default(fn($record) => $record?->translation($locale)?->technologies),


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Portfolio::query()->with(['translations'])
            )
            ->columns([
                // TextColumn::make('id')->sortable(),
                // // TextColumn::make('translation_name')
                // //     ->label('Անվանում')
                // //     ->searchable(),
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Անվանում')
                    ->getStateUsing(fn($record) => $record->translation('hy')?->name ?? '(нет названия)'),

                ToggleColumn::make('active')->label('Ակտիվ'),
            ])
            ->filters(self::makeDynamicFilters([
                'name' => [
                    'label' => 'Անվանում',
                    'relation' => 'translations',
                    'column' => 'name',
                    'operator' => 'like',
                ],
                'active' => [
                    'type' => 'ternary',
                    'label' => 'Ակտիվ',
                    'trueLabel' => 'Այո',
                    'falseLabel' => 'Ոչ',
                ],
            ]))
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }


    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class,
        ];
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }


    public static function getNavigationLabel(): string
    {
        return 'Պորտֆոլիո';
    }

    // Также можешь переопределить заголовок страницы, если нужно:
    public static function getModelLabel(): string
    {
        return 'Պորտֆոլիո';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Պորտֆոլիո';
    }
}
