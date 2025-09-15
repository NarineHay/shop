<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'color' => [
                'type' => 'string',
                'translations' => ['hy' => 'Գույն', 'en' => 'Color', 'ru' => 'Цвет'],
                'values' => [
                    ['code' => 'red', 'translations' => ['hy' => 'Կարմիր', 'en' => 'Red', 'ru' => 'Красный']],
                    ['code' => 'blue', 'translations' => ['hy' => 'Կապույտ', 'en' => 'Blue', 'ru' => 'Синий']],
                ],
            ],
            'battery_capacity' => [
                'type' => 'integer',
                'translations' => ['hy' => 'Մարտկոցի տարողություն', 'en' => 'Battery Capacity', 'ru' => 'Ёмкость батареи'],
                'values' => [
                    ['code' => 'b3000', 'translations' => ['hy' => '3000 mAh', 'en' => '3000 mAh', 'ru' => '3000 мАч']],
                    ['code' => 'b5000', 'translations' => ['hy' => '5000 mAh', 'en' => '5000 mAh', 'ru' => '5000 мАч']],
                ],
            ],
            'weight' => [
                'type' => 'integer',
                'translations' => ['hy' => 'Կշիռ', 'en' => 'Weight', 'ru' => 'Вес'],
                'values' => [
                    ['code' => 'w150', 'translations' => ['hy' => '150 գ', 'en' => '150 g', 'ru' => '150 г']],
                    ['code' => 'w200', 'translations' => ['hy' => '200 գ', 'en' => '200 g', 'ru' => '200 г']],
                ],
            ],
        ];

        foreach ($attributes as $slug => $data) {
            $attribute = Attribute::updateOrCreate(
                ['slug' => $slug],
                ['type' => $data['type']]
            );

            foreach ($data['translations'] as $locale => $name) {
                AttributeTranslation::updateOrCreate(
                    ['attribute_id' => $attribute->id, 'locale' => $locale],
                    ['name' => $name]
                );
            }

            foreach ($data['values'] as $val) {
                $value = AttributeValue::updateOrCreate(
                    ['attribute_id' => $attribute->id, 'code' => $val['code']],
                    []
                );

                foreach ($val['translations'] as $locale => $valueName) {
                    AttributeValueTranslation::updateOrCreate(
                        ['attribute_value_id' => $value->id, 'locale' => $locale],
                        ['name' => $valueName]
                    );
                }
            }
        }
    }
}
