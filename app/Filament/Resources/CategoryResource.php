<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Traits\DynamicFilterTrait;
use App\Models\Category;
use App\Services\Categories\CategoryService;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    use DynamicFilterTrait;

    public function __construct(protected CategoryService $categoryService)
    {

    }
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public const SUPPORTED_LOCALES = [
        'ru' => 'Русский',
        'hy' => 'Հայերեն',
        'en' => 'English',
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([
                Select::make('parent_id')
                    ->label('Ծնողի կատեգորիա')
                    ->options(fn ($get) => self::getCategoryOptionsIndented(excludeId: $get('id')))
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Toggle::make('active')
                    ->label('Ակտիվ')
                    ->default(true),

                Tabs::make('Translations')
                    ->tabs(
                        collect(self::SUPPORTED_LOCALES)->map(
                            fn($label, $locale) => self::makeLangTab($locale, $label)
                        )->toArray()
                    ),
            ])
        ]);
    }

    protected static function makeLangTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("translations.{$locale}.name")
                ->label('Անվանում')
                ->required(),

            TextInput::make("translations.{$locale}.slug")
                ->label('Slug')
                ->required()
                ->unique(
                    table: 'category_translations',
                    column: 'slug',
                    ignoreRecord: true, // чтобы можно было редактировать без ошибки
                )
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Category::query()->with(['translations', 'parent.translations']))
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Անվանում')
                    ->getStateUsing(fn ($record) => self::renderIndentedName($record))
                    ->html(),

                TextColumn::make('parent_name')
                    ->label('Ծնողի կատեգորիա')
                    ->getStateUsing(fn ($record) => $record->parent?->translation('hy')?->name ?? '—'),

                ToggleColumn::make('active')
                    ->label('Ակտիվ'),
            ])
            ->filters(self::makeDynamicFilters([
                'name' => [
                    'label' => 'Անվանում',
                    'relation' => 'translations',
                    'column' => 'name',
                    'operator' => 'like',
                ],
                'parent.name' => [
                    'label' => 'Ծ․ կատեգորիայի անվանում',
                    'relation' => 'parent.translations',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    protected static function getCategoryOptionsIndented($categories = null, $prefix = '', $excludeId = null): array
    {
        $categories = $categories ?? Category::with(['translations', 'children.translations'])->whereNull('parent_id')->get();
        // $categories = $categories ?? self::$categoryService->getActiveRows(['translations', 'children.translations'])->whereNull('parent_id')->get();


        return $categories->flatMap(function ($category) use ($prefix, $excludeId) {
            if ($excludeId && $category->id === $excludeId) {
                return [];
            }

            $name = $category->translation('hy')?->name ?? '(без названия)';
            $options = [$category->id => $prefix . $name];

            if ($category->children->isNotEmpty()) {
                $childOptions = self::getCategoryOptionsIndented($category->children, $prefix . '— ', $excludeId);
                $options += $childOptions;
            }

            return $options;
        })->toArray();
    }

    protected static function renderIndentedName($record, string $locale = 'hy'): string
    {
        $depth = $record->getDepth();
        $indent = str_repeat('➝ ', $depth);
        $icon = '📁 ';
        $name = e($record->translation($locale)?->name ?? '(անանուն)');
        return "<span>{$icon}{$indent}{$name}</span>";
    }

    public static function getNavigationLabel(): string
    {
        return 'Կատեգորիա';
    }

    public static function getModelLabel(): string
    {
        return 'Կատեգորիա';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Կատեգորիաներ';
    }
}
