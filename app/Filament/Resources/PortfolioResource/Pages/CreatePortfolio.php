<?php

namespace App\Filament\Resources\PortfolioResource\Pages;

use App\Filament\Resources\PortfolioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

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
                'name' => $values['name'] ?? '',
                'slug' => $values['slug'] ?? '',
                'description' => $values['description'] ?? '',
                'technologies' => $values['technologies'] ?? '',


            ]);
        }
    }
}
