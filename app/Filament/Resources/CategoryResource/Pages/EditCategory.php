<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;
    protected array $translations = [];
    protected ?string $oldImage = null;
    // Перед заполнением формы подтягиваем переводы в нужном формате
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['translations'] = $this->record->translations->keyBy('locale')->map(function ($translation) {
            return [
                'name' => $translation->name,
                'description' => $translation->description,
                'slug' => $translation->slug,
            ];
        })->toArray();

        return $data;
    }

    // Перед сохранением отделяем переводы из данных
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->translations = $data['translations'] ?? [];
        unset($data['translations']);
        $this->oldImage = $this->record->image;

        return $data;
    }

    // После сохранения обновляем или создаём переводы
    protected function afterSave(): void
    {

        if (
            $this->oldImage &&
            $this->oldImage !== $this->record->image
        ) {
            Storage::disk('public')->delete($this->oldImage);
        }

        foreach ($this->translations as $locale => $values) {
            $translation = $this->record->translations()->where('locale', $locale)->first();

            if ($translation) {
                $translation->update([
                    'name' => $values['name'] ?? '',
                    'description' => $values['description'] ?? '',
                    'slug' => $values['slug'] ?? '',
                ]);
            } else {
                $this->record->translations()->create([
                    'locale' => $locale,
                    'name' => $values['name'] ?? '',
                    'description' => $values['description'] ?? '',
                    'slug' => $values['slug'] ?? '',
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
