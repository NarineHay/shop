<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAttributes extends ListRecords
{
    protected static string $resource = AttributeResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->leftJoin('attribute_translations as at', function ($join) {
            $join->on('attributes.id', '=', 'at.attribute_id')
                ->where('at.locale', '=', 'hy'); // укажи нужную локаль
        })
            ->select('attributes.*', 'at.name as translated_name');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
