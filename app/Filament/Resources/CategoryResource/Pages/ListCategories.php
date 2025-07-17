<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;
 protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->leftJoin('category_translations as ct', function ($join) {
            $join->on('categories.id', '=', 'ct.category_id')
                 ->where('ct.locale', '=', 'am'); // укажи нужную локаль
        })
        ->select('categories.*', 'ct.name as translated_name');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
