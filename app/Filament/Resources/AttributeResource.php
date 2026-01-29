<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttributeResource\Pages;
use App\Filament\Resources\AttributeResource\RelationManagers\ValuesRelationManager;
use App\Models\Attribute;
use App\Models\Category;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AttributeResource extends Resource
{
    protected static ?string $model = Attribute::class;

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

                // ✅ Category — только в форме
                Select::make('category_id')
                    ->label('Category')
                    ->options(function () {
                        // Берём текущую локаль (например hy)
                        $locale = app()->getLocale();

                        // Получаем категории с переводами
                        return \App\Models\CategoryTranslation::query()
                            ->where('locale', $locale)
                            ->pluck('name', 'category_id')
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                // ✅ Slug — только в форме
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Tabs::make('Translations')
                    ->tabs(
                        collect(self::SUPPORTED_LOCALES)->map(
                            fn ($label, $locale) => self::makeLangTab($locale, $label)
                        )->toArray()
                    ),


// Repeater::make('values')
//     ->label('Attribute values')
//     ->schema([
//         TextInput::make('code')
//             ->label('Code')
//             ->nullable()
//             ->maxLength(50),

//         Tabs::make('Value translations')
//             ->tabs(
//                 collect(self::SUPPORTED_LOCALES)->map(
//                     fn ($label, $locale) => Tab::make($label)->schema([
//                         TextInput::make("translations.{$locale}.name")
//                             ->label('Name')
//                             ->required(),
//                     ])
//                 )->toArray()
//             ),
//     ])
//     ->addActionLabel('Add value')
//     ->reorderable()
//     ->collapsible()
//     ->defaultItems(0)
//     ->columnSpanFull(),
            ]),


        ]);
    }

    protected static function makeLangTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("translations.{$locale}.name")
                ->label('Անվանում')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, callable $set) use ($locale) {
                    // slug автогенерация ТОЛЬКО из EN
                    if ($locale === 'en') {
                        $set('slug', Str::slug($state));
                    }
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Attribute::query()->with('translations'))
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Անվանում')
                    ->getStateUsing(fn ($record) =>
                        $record->translations
                            ->firstWhere('locale', 'hy')
                            ?->name
                    ),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ValuesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }
}
