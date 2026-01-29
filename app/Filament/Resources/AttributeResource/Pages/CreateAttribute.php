<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;

class CreateAttribute extends CreateRecord
{
    protected static string $resource = AttributeResource::class;
    protected array $translations = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Отделим translations перед сохранением
        $this->translations = Arr::pull($data, 'translations');
        return $data;
    }

    protected function afterCreate(): void
    {
        foreach ($this->translations as $locale => $values) {
            $this->record->translations()->create([
                'locale' => $locale,
                'name' => $values['name'] ?? ''
            ]);
        }
    }
}
