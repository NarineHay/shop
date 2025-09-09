<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;
    protected array $translations = [];
    protected array $attributeValuesToSync = [];


    // Перед заполнением формы подтягиваем переводы в нужном формате
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['translations'] = $this->record->translations->keyBy('locale')->map(function ($translation) {
            return [
                'name' => $translation->name,
                'slug' => $translation->slug,
                'description' => $translation->description,

            ];
        })->toArray();

        // Уже выбранные attribute_values
        $attributeValueIds = $this->record->attributeValues
            ->groupBy('attribute_id') // группируем все значения по атрибуту
            ->map(fn($group) => $group->pluck('id')->toArray()) // достаем все id
            ->toArray();

        $data['attribute_value_ids'] = $attributeValueIds;


        return $data;
    }

    // Перед сохранением отделяем переводы из данных
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->translations = $data['translations'] ?? [];
        unset($data['translations']);

        $this->attributeValuesToSync = collect($data['attribute_value_ids'] ?? [])
            ->flatten()
            ->filter()
            ->toArray();
        unset($data['attribute_value_ids']);

        return $data;
    }

    // После сохранения обновляем или создаём переводы
    protected function afterSave(): void
    {
        foreach ($this->translations as $locale => $values) {
            $translation = $this->record->translations()->where('locale', $locale)->first();

            if ($translation) {
                $translation->update([
                    'name' => $values['name'] ?? '',
                    'slug' => $values['slug'] ?? '',
                    'description' => $values['description'] ?? '',

                ]);
            } else {
                $this->record->translations()->create([
                    'locale' => $locale,
                    'name' => $values['name'] ?? '',
                    'slug' => $values['slug'] ?? '',
                    'description' => $values['description'] ?? '',

                ]);
            }
        }

        // Атрибуты
        if (!empty($this->attributeValuesToSync)) {
            $this->record->attributeValues()->sync($this->attributeValuesToSync);
        }
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
