<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\{Group, Select, Tabs, TextInput, Textarea, Toggle};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\{TextColumn, ToggleColumn};
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([
                Select::make('category_id')
                    ->label('Կատեգորիա')
                    ->options(fn () => Category::with('translations')->get()->mapWithKeys(
                        fn ($cat) => [$cat->id => $cat->translation('hy')?->name ?? '(без названия)']
                    ))
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('price')
                    ->label('Արժեք')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->suffix(' ֏'),

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
                ->default(fn($record) => $record?->translation($locale)?->slug),

            Textarea::make("translations.{$locale}.description")
                ->label('Նկարագրություն')
                ->rows(4)
                ->default(fn($record) => $record?->translation($locale)?->description),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                // TextColumn::make('translation_name')
                //     ->label('Անվանում')
                //     ->searchable(),

                TextColumn::make('name')
                    ->label('Անվանում')
                    ->getStateUsing(fn ($record) => $record->translation('hy')?->name ?? '(нет названия)')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Արժեք')
                    ->suffix(' ֏'),
                ToggleColumn::make('active')->label('Ակտիվ'),
            ])
            ->filters([])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }


    public static function getNavigationLabel(): string
    {
        return 'Ապրանք';
    }

    // Также можешь переопределить заголовок страницы, если нужно:
    public static function getModelLabel(): string
    {
        return 'Ապրանք';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Ապրանքներ';
    }

}
