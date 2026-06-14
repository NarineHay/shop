<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryPageResource\Pages;
use App\Models\Category;
use App\Models\CategoryPage;
use App\Filament\Traits\DynamicFilterTrait;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryPageResource extends Resource
{
    use DynamicFilterTrait;
    protected static ?string $model = CategoryPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public const SUPPORTED_LOCALES = [
        'ru' => 'Русский',
        'hy' => 'Հայերեն',
        'en' => 'English',
    ];

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([

                Select::make('category_id')
                    ->label('Կատեգորիա')
                    ->options(function ($record) {

                        $query = Category::query()
                            ->whereNull('parent_id')
                            ->with('translations');

                        if (!$record) {
                            $query->whereDoesntHave('page');
                        } else {
                            $query->where(function ($q) use ($record) {
                                $q->whereDoesntHave('page')
                                    ->orWhere('id', $record->category_id);
                            });
                        }

                        return $query
                            ->get()
                            ->mapWithKeys(fn($category) => [
                                $category->id =>
                                $category->translation('hy')?->name
                                    ?? "ID {$category->id}"
                            ]);
                    })
                    ->preload()
                    ->disabled(fn($record) => $record !== null)
                    ->required(),

                Tabs::make('Translations')
                    ->tabs(
                        collect(self::SUPPORTED_LOCALES)->map(
                            fn($label, $locale) => self::makeLangTab($locale, $label)
                        )->toArray()
                    ),
                    
                FileUpload::make('banner_image')
                    ->label('Banner')
                    ->image()
                    ->disk('public')
                    ->directory(
                        fn($record) => $record
                            ? "category-pages/{$record->id}"
                            : "category-pages/temp"
                    )
                    ->getUploadedFileNameForStorageUsing(
                        fn($file) => $file->hashName()
                    ),

            ])
        ]);
    }

    protected static function makeLangTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([

            TextInput::make("translations.{$locale}.banner_title")
                ->label('Banner Title')
                ->maxLength(255),

            Textarea::make("translations.{$locale}.banner_text")
                ->label('Banner Text')
                ->rows(6),

            TextInput::make("translations.{$locale}.page_title")
                ->label('Page Title')
                ->maxLength(255),

            RichEditor::make("translations.{$locale}.content")
                ->label('Content')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                CategoryPage::query()->with([
                    'category.translations',
                    'translations',
                ])
            )
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('category_name')
                    ->label('Կատեգորիա')
                    ->getStateUsing(
                        fn($record) =>
                        $record->category?->translation('hy')?->name ?? '—'
                    ),

                TextColumn::make('updated_at')
                    ->label('Թարմացվել է')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters(self::makeDynamicFilters([
                'category.name' => [
                    'label' => 'Կատեգորիա',
                    'relation' => 'category.translations',
                    'column' => 'name',
                    'operator' => 'like',
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
            'index' => Pages\ListCategoryPages::route('/'),
            'create' => Pages\CreateCategoryPage::route('/create'),
            'edit' => Pages\EditCategoryPage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Կատեգորիայի էջեր';
    }

    public static function getModelLabel(): string
    {
        return 'Կատեգորիայի էջ';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Կատեգորիայի էջեր';
    }
}
