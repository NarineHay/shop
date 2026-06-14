<?php

namespace App\Filament\Resources\CategoryPageResource\Pages;

use App\Filament\Resources\CategoryPageResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CreateCategoryPage extends CreateRecord
{
    protected static string $resource = CategoryPageResource::class;

    protected array $translations = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->translations = Arr::pull($data, 'translations');

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->record->banner_image) {

            $oldPath = $this->record->banner_image;

            $newPath = 'category-pages/' .
                $this->record->id .
                '/' .
                basename($oldPath);

            Storage::disk('public')->move($oldPath, $newPath);

            $this->record->update([
                'banner_image' => $newPath,
            ]);
        }

        foreach ($this->translations as $locale => $values) {

            $this->record->translations()->create([
                'locale' => $locale,
                'banner_title' => $values['banner_title'] ?? '',
                'banner_text' => $values['banner_text'] ?? '',
                'page_title' => $values['page_title'] ?? '',
                'content' => $values['content'] ?? '',
            ]);
        }
    }
}
