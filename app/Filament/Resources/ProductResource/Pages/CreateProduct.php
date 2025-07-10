<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
protected function mutateFormDataBeforeCreate(array $data): array
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

        // Сохраним продукт
        $product = Product::create($data);

        // Сохраним переводы
        foreach ($translations as $locale => $fields) {
            $product->translations()->create(array_merge($fields, ['locale' => $locale]));
        }

        return $data;
    }
}
