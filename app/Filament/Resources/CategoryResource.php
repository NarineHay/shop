<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make([
                Select::make('parent_id')
                    ->label('Родительская категория')
                    ->options(function () {
                        return Category::with('translations')->get()->mapWithKeys(function ($cat) {
                            return [$cat->id => $cat->translation()?->name ?? '(без названия)'];
                        });
                    })
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Toggle::make('active')
                    ->label('Активна')
                    ->default(true),

                Tabs::make('Translations')
                    ->tabs([
                        self::makeLangTab('ru', 'Русский'),
                        self::makeLangTab('am', 'Հայերեն'),
                        self::makeLangTab('en', 'English'),
                    ])
            ])
        ]);
    }

    protected static function makeLangTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            TextInput::make("translations.{$locale}.name")
                ->label("Название")
                ->required(),

            TextInput::make("translations.{$locale}.slug")
                ->label("Slug")
                ->required()

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),

                TextColumn::make('name')
                    ->label('Название')
                    ->getStateUsing(fn ($record) => $record->translation()?->name ?? '(нет названия)')
                    ->sortable()
                    ->searchable(),

                ToggleColumn::make('active')->label('Активна'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
}
