<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\StockRelationManager;
use App\Filament\Traits\DynamicFilterTrait;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Services\Categories\CategoryService;
use Filament\Forms\Components\{Group, Repeater, Select, Tabs, TextInput, Textarea, Toggle};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\{TextColumn, ToggleColumn};
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class ProductResource extends Resource
{
    use DynamicFilterTrait;
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([
                Select::make('category_id')
                    ->label('Կատեգորիա')
                    ->options(function (CategoryService $service) {
                        $categories = $service->getActiveRows(['translations', 'children'])
                            ->whereNull('parent_id');

                        return self::buildCategoryOptions($categories);
                    })
                    ->searchable()
                    ->required(),

                TextInput::make('price')
                    ->label('Արժեք')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->suffix(' ֏'),

                // TextInput::make('quantity')
                //     ->label('Քանակ')
                //     ->numeric()
                //     ->integer()
                //     ->required(),
                TextInput::make('stock_quantity')
                    ->label('Քանակ')
                    ->numeric()
                    ->integer()
                    ->default(fn($record) => $record->stock?->quantity ?? 0),

                TextInput::make('sku')
                    ->label('Արտ. համարը')
                    ->required(),

                TextInput::make('seria')
                    ->label('Արտ. Սերիա')
                    ->required(),

                Toggle::make('active')->label('Ակտիվ')->default(true),

                Tabs::make('Translations')->tabs([
                    self::langTab('ru', 'Русский'),
                    self::langTab('hy', 'Հայերեն'),
                    self::langTab('en', 'English'),
                ]),
            ]),
            Tabs::make('Attributes')
                ->tabs(
                    Attribute::with('values.translations')
                        ->get()
                        ->map(fn($attribute) => Tab::make($attribute->translation('hy')?->name ?? '—')
                            ->schema([
                                Select::make("attribute_value_ids.{$attribute->id}")
                                    ->label($attribute->translation('hy')?->name ?? '—')
                                    ->multiple()
                                    ->options(
                                        $attribute->values
                                            ->mapWithKeys(fn($val) => [
                                                $val->id => $val->translation('hy')?->name ?? '—'
                                            ])
                                    )
                                    ->preload()
                                    ->searchable(),
                            ])
                        )
                        ->toArray()
            )

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

                    $rule = Rule::unique('product_translations', 'slug')
                        ->where(fn($query) => $query->where('locale', $locale));

                    if ($translationId) {
                        $rule->ignore($translationId);
                    }

                    return $rule;
                }),

            Textarea::make("translations.{$locale}.description")
                ->label('Նկարագրություն')
                ->rows(4)
                ->default(fn($record) => $record?->translation($locale)?->description),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()->with(['translations', 'category.translations'])
            )
            ->columns([
                TextColumn::make('id')->sortable(),
                // TextColumn::make('translation_name')
                //     ->label('Անվանում')
                //     ->searchable(),
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Անվանում')
                    ->getStateUsing(fn ($record) => $record->translation('hy')?->name ?? '(нет названия)'),

                TextColumn::make('category.translations.name')
                    ->label('Կատեգորիա')
                    ->getStateUsing(fn ($record) => $record->category?->translation('hy')?->name ?? '—'),

                TextColumn::make('price')
                    ->label('Արժեք')
                    ->suffix(' ֏'),

                // TextColumn::make('quantity')
                //     ->label('Քանակ')
                //     ->sortable(),

                TextColumn::make('stock.quantity')
                    ->label('Քանակ')
                    ->sortable(),

                TextColumn::make('sku')
                    ->label('Արտ. համարը')
                    ->sortable(),

                ToggleColumn::make('active')->label('Ակտիվ'),
            ])
             ->filters(self::makeDynamicFilters([
                'name' => [
                    'label' => 'Անվանում',
                    'relation' => 'translations',
                    'column' => 'name',
                    'operator' => 'like',
                ],
                'category.name' => [
                    'label' => 'կատեգորիայի ',
                    'relation' => 'category.translations',
                    'column' => 'name',
                    'operator' => 'like',
                ],
                'price' => [
                    'type' => 'range',
                    'label' => 'Արժեք ',
                    'column' => 'price'
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

    private static function buildCategoryOptions($categories, $prefix = ''): array
    {
        $options = [];

        foreach ($categories as $category) {
            $options[$category->id] =
                $prefix . ($category->translation('hy')?->name ?? '(без названия)');

            if ($category->children->isNotEmpty()) {
                $options += self::buildCategoryOptions(
                    $category->children,
                    $prefix . '— '
                );
            }
        }

        return $options;
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
