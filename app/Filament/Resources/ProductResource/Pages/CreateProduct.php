<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected array $translations = [];
    protected array $attributeValuesToSync = [];
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Отделим translations перед сохранением
        $this->translations = Arr::pull($data, 'translations');

        // Отделяем attribute_value_ids (pivot)
        $this->attributeValuesToSync = collect(Arr::pull($data, 'attribute_value_ids', []))
            ->flatten()
            ->filter()
            ->toArray();

        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->translations as $locale => $values) {
            $this->record->translations()->create([
                'locale' => $locale,
                'name' => $values['name'] ?? '',
                'slug' => $values['slug'] ?? '',
                'description' => $values['description'] ?? '',

            ]);
        }

        if (!empty($this->attributeValuesToSync)) {
            $this->record->attributeValues()->sync($this->attributeValuesToSync);
        }
    }
}
