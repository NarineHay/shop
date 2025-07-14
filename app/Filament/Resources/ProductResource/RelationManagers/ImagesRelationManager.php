<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductImage;
use Filament\Tables;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Actions\{CreateAction, EditAction, DeleteAction, Action};
use Filament\Tables\Columns\{ImageColumn, IconColumn};
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('path')
                ->label('Պատկեր')
                ->image()
                ->directory('products')
                ->preserveFilenames()
                ->required(),

            Toggle::make('is_main')->label('Գլխավոր պատկեր'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path_url')->label('Նախադիտում')->circular(),
                IconColumn::make('is_main')->label('Գլխավոր')->boolean(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('setAsMain')
                    ->label('Դարձրեք այն գլխավորը')
                    ->icon('heroicon-o-star')
                    ->requiresConfirmation()
                    ->visible(fn (Model $record) => !$record->is_main)
                    ->action(function (Model $record) {
                        ProductImage::where('product_id', $record->product_id)->update(['is_main' => false]);
                        $record->update(['is_main' => true]);
                    }),
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return 'Պատկեր';
    }

    // Также можешь переопределить заголовок страницы, если нужно:
    public static function getModelLabel(): string
    {
        return 'Պատկեր';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Պատկերներ';
    }
}
