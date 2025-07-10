<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
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

class ProductResource1 extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Group::make([
                Select::make('category_id')
                    ->label('Категория')
                    ->options(function () {
                        return Category::with('translations')->get()
                            ->mapWithKeys(fn ($cat) => [
                                $cat->id => $cat->translation()?->name ?? '(без названия)',
                            ]);
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                Toggle::make('active')
                    ->label('Активен')
                    ->default(true),

                Tabs::make('Translations')->tabs([
                    self::langTab('ru', 'Русский'),
                    self::langTab('am', 'Հայերեն'),
                    self::langTab('en', 'English'),
                ]),
            ]),
        ]);
    }

    // protected static function langTab(string $locale, string $label): Tab
    // {
    //     return Tab::make($label)->schema([
    //         TextInput::make("translations.{$locale}.name")
    //             ->label('Название')
    //             ->required(),

    //         TextInput::make("translations.{$locale}.slug")
    //             ->label('Slug')
    //             ->required(),

    //         Textarea::make("translations.{$locale}.description")
    //             ->label('Описание')
    //             ->rows(4),
    //     ]);
    // }

    protected static function langTab(string $locale, string $label): Tab
{
    return Tab::make($label)->schema([
        TextInput::make("name_{$locale}")
            ->label('Название')
            ->required(),

        TextInput::make("slug_{$locale}")
            ->label('Slug')
            ->required(),

        Textarea::make("description_{$locale}")
            ->label('Описание')
            ->rows(4),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')
                    ->label('Название')
                    ->getStateUsing(fn ($record) => $record->translation()?->name ?? '(без названия)')
                    ->searchable(),
                ToggleColumn::make('active')->label('Активен'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
}
