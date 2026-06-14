<?php

namespace App\Filament\Resources\CategoryPageResource\Pages;

use App\Filament\Resources\CategoryPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCategoryPage extends EditRecord
{
    protected static string $resource = CategoryPageResource::class;

    protected array $translations = [];

    protected ?string $oldBanner = null;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['translations'] = $this->record->translations
            ->keyBy('locale')
            ->map(function ($translation) {
                return [
                    'banner_title' => $translation->banner_title,
                    'banner_text' => $translation->banner_text,
                    'page_title' => $translation->page_title,
                    'content' => $translation->content,
                ];
            })
            ->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->translations = $data['translations'] ?? [];

        unset($data['translations']);

        $this->oldBanner = $this->record->banner_image;

        return $data;
    }

    protected function afterSave(): void
    {
        if (
            $this->oldBanner &&
            $this->oldBanner !== $this->record->banner_image
        ) {
            Storage::disk('public')->delete($this->oldBanner);
        }

        foreach ($this->translations as $locale => $values) {

            $translation = $this->record
                ->translations()
                ->where('locale', $locale)
                ->first();

            if ($translation) {

                $translation->update([
                    'banner_title' => $values['banner_title'] ?? '',
                    'banner_text' => $values['banner_text'] ?? '',
                    'page_title' => $values['page_title'] ?? '',
                    'content' => $values['content'] ?? '',
                ]);
            } else {

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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
