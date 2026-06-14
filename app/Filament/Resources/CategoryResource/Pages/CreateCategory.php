<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    protected array $translations = [];
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Отделим translations перед сохранением
        $this->translations = Arr::pull($data, 'translations');
        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->record->image) {

            $oldPath = $this->record->image;

            $newPath = "categories/{$this->record->id}/" . basename($oldPath);

            Storage::disk('public')->move($oldPath, $newPath);

            $this->record->update([
                'image' => $newPath,
            ]);
        }

        foreach ($this->translations as $locale => $values) {
            $this->record->translations()->create([
                'locale' => $locale,
                'name' => $values['name'] ?? '',
                'description' => $values['description'] ?? '',
                'slug' => $values['slug'] ?? '',
            ]);
        }
    }
}
