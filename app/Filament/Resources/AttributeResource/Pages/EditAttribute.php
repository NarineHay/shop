<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use Filament\Resources\Pages\EditRecord;

class EditAttribute extends EditRecord
{
    protected static string $resource = AttributeResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // подтягиваем переводы для атрибута
        $data['translations'] = $this->record->translations->keyBy('locale')->map(fn($t) => ['name'=>$t->name])->toArray();

        // подтягиваем attribute_values + их переводы
        $data['values'] = $this->record->values->map(function($value){
            $translations = $value->translations->keyBy('locale')->map(fn($t)=>['name'=>$t->name])->toArray();
            return [
                'id'=>$value->id,
                'code'=>$value->code,
                'translations'=>$translations,
            ];
        })->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->record->translations()->each(function($translation) use ($data) {
            $locale = $translation->locale;
            if(isset($data['translations'][$locale])){
                $translation->update([
                    'name'=>$data['translations'][$locale]['name'] ?? $translation->name
                ]);
            }
        });

        // значения атрибута
        if(isset($data['values'])){
            foreach($data['values'] as $valueData){
                // если value существует
                $value = isset($valueData['id']) ? $this->record->values()->find($valueData['id']) : null;

                if(!$value){
                    // создаем новый
                    $value = $this->record->values()->create(['code'=>$valueData['code'] ?? null]);
                } else {
                    // обновляем code, если value не привязан к продуктам
                    if($value->products()->count() === 0){
                        $value->update(['code'=>$valueData['code'] ?? $value->code]);
                    }
                }

                // перевод для value
                foreach(AttributeResource::SUPPORTED_LOCALES as $locale => $_){
                    $name = $valueData['translations'][$locale]['name'] ?? null;
                    if($name){
                        $value->translations()->updateOrCreate(
                            ['locale'=>$locale],
                            ['name'=>$name]
                        );
                    }
                }
            }
        }

        return $data;
    }
}
