<?php

namespace App\Filament\Resources\CategoryPageResource\Pages;

use App\Filament\Resources\CategoryPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryPages extends ListRecords
{
    protected static string $resource = CategoryPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
