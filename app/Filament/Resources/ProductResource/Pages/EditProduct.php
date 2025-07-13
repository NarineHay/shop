<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;
    protected array $translations = [];

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

        return $data;
    }

    // Перед сохранением отделяем переводы из данных
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->translations = $data['translations'] ?? [];
        unset($data['translations']);

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
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
