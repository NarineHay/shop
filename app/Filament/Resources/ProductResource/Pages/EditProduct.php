<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;
protected function mutateFormDataBeforeSave(array $data): array
    {
        $translations = [
            'ru' => [
                'name' => $data['name_ru'],
                'slug' => $data['slug_ru'],
                'description' => $data['description_ru'],
            ],
            'am' => [
                'name' => $data['name_am'],
                'slug' => $data['slug_am'],
                'description' => $data['description_am'],
            ],
            'en' => [
                'name' => $data['name_en'],
                'slug' => $data['slug_en'],
                'description' => $data['description_en'],
            ],
        ];

        unset(
            $data['name_ru'], $data['slug_ru'], $data['description_ru'],
            $data['name_am'], $data['slug_am'], $data['description_am'],
            $data['name_en'], $data['slug_en'], $data['description_en'],
        );

        foreach ($translations as $locale => $fields) {
            $this->record->translations()->updateOrCreate(
                ['locale' => $locale],
                $fields
            );
        }

        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
