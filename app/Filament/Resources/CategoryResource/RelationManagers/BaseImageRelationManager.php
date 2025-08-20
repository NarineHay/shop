<?php

namespace App\Filament\Resources\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Table;
use Filament\Tables\Columns\{ImageColumn, IconColumn};
use Filament\Tables\Actions\{CreateAction, EditAction, DeleteAction, Action};
use Illuminate\Database\Eloquent\Model;

class BaseImageRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    // Папка для загрузки файлов, задается в наследниках
    protected static string $imageDirectory = 'images';

    // Модель (для setAsMain), задается в наследниках
    protected static string $imageModel;

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('path')
                ->label('Պատկեր')
                ->image()
                ->directory(static::$imageDirectory)
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
                    ->visible(fn(Model $record) => !$record->is_main)
                    ->action(function (Model $record) {
                        $model = static::$imageModel;
                        $model::where($record->getForeignKey(), $record->{$record->getForeignKey()})->update(['is_main' => false]);
                        $record->update(['is_main' => true]);
                    }),
            ]);
    }
}
