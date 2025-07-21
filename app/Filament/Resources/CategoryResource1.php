<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Traits\DynamicFilterTrait;
use App\Models\Category;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource1 extends Resource
{
    use DynamicFilterTrait;
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([
                // Select::make('parent_id')
                //     ->label('Ծնողի կատեգորիա')
                //     ->options(function () {
                //         return Category::with('translations')->get()->mapWithKeys(function ($cat) {
                //             return [$cat->id => $cat->translation('am')?->name ?? '(без названия)'];
                //         });
                //     })
                //     ->searchable()
                //     ->preload()
                //     ->nullable(),

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
                    ->tabs([
                        self::makeLangTab('ru', 'Русский'),
                        self::makeLangTab('hy', 'Հայերեն'),
                        self::makeLangTab('en', 'English'),
                    ])
            ])
        ]);
    }

    protected static function makeLangTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("translations.{$locale}.name")
                ->label("Անվանում")
                ->required(),

            TextInput::make("translations.{$locale}.slug")
                ->label("Slug")
                ->required()

        ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->query(Category::query()->with(['parent.translations', 'translations']))
        ->columns([
            TextColumn::make('id')
                ->label('ID')
                ->sortable(),

            TextColumn::make('name')
                ->label('Անվանում')
                ->getStateUsing(function ($record) {
                    $depth = $record->getDepth();
                    $indent = str_repeat('➝ ', $depth);
                    $icon = '📁 ';
                    $name = e($record->translation('hy')?->name ?? '(անանուն)');
                    return "<span>{$icon}{$indent}{$name}</span>";
                })
                ->html(),

            TextColumn::make('parent_name')
                ->label('Ծնողի կատեգորիա')
                ->getStateUsing(fn ($record) => $record->parent?->translation('hy')?->name ?? '—'),

            ToggleColumn::make('active')
                ->label('Ակտիվ'),
        ])
        ->filters([
            Filter::make('name')
                ->form([
                    TextInput::make('value')->label('Название'),
                ])
                ->query(function ($query, array $data) {
                    if (empty($data['value'])) return;
                    $query->whereHas('translations', function ($q) use ($data) {
                        $q->where('locale', 'am')
                          ->where('name', 'like', '%' . $data['value'] . '%');
                    });
                }),

            Filter::make('parent.name')
                ->label('Родитель')
                ->form([
                    TextInput::make('value')->label('Родитель'),
                ])
                ->query(function ($query, array $data) {
                    if (empty($data['value'])) return;
                    $query->whereHas('parent.translations', function ($q) use ($data) {
                        $q->where('locale', 'am')
                          ->where('name', 'like', '%' . $data['value'] . '%');
                    });
                }),

            TernaryFilter::make('active')
                ->label('Активна')
                ->trueLabel('Да')
                ->falseLabel('Нет'),

            // Filter::make('order')
            //     ->form([
            //         TextInput::make('from')->label('Порядок от')->numeric(),
            //         TextInput::make('to')->label('Порядок до')->numeric(),
            //     ])
            //     ->query(function ($query, array $data) {
            //         if (!empty($data['from'])) {
            //             $query->where('order', '>=', $data['from']);
            //         }
            //         if (!empty($data['to'])) {
            //             $query->where('order', '<=', $data['to']);
            //         }
            //     }),
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
        $categories = $categories ?? Category::with('translations', 'children')->whereNull('parent_id')->get();

        $result = [];

        foreach ($categories as $category) {
            // Пропускаем саму себя при редактировании, чтобы не назначать категорию родителем самой себе
            if ($excludeId && $category->id === $excludeId) {
                continue;
            }

            $name = $category->translation('am')?->name ?? '(без названия)';
            $result[$category->id] = $prefix . $name;

            if ($category->children && $category->children->count()) {
                $childOptions = self::getCategoryOptionsIndented($category->children, $prefix . '— ', $excludeId);
                $result += $childOptions;
            }
        }

        return $result;
    }



    public static function getNavigationLabel(): string
    {
        return 'Կատեգորիա';
    }

    // Также можешь переопределить заголовок страницы, если нужно:
    public static function getModelLabel(): string
    {
        return 'Կատեգորիա';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Կատեգորիաներ';
    }
}
