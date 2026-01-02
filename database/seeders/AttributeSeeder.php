<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeTranslation;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [

            /*
            |--------------------------------------------------------------------------
            | COMMERCIAL ATTRIBUTES
            |--------------------------------------------------------------------------
            */

            'color' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Գույն',
                    'en' => 'Color',
                    'ru' => 'Цвет',
                ],
                'values' => [
                    ['code' => 'black', 'translations' => [
                        'hy' => 'Սև',
                        'en' => 'Black',
                        'ru' => 'Чёрный',
                    ]],
                    ['code' => 'white', 'translations' => [
                        'hy' => 'Սպիտակ',
                        'en' => 'White',
                        'ru' => 'Белый',
                    ]],
                    ['code' => 'grey', 'translations' => [
                        'hy' => 'Մոխրագույն',
                        'en' => 'Grey',
                        'ru' => 'Серый',
                    ]],
                    ['code' => 'blue', 'translations' => [
                        'hy' => 'Կապույտ',
                        'en' => 'Blue',
                        'ru' => 'Синий',
                    ]],
                ],
            ],

            'product_type' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ապրանքի տեսակ',
                    'en' => 'Product Type',
                    'ru' => 'Тип товара',
                ],
                'values' => [
                    ['code' => 'variable_speed_drive', 'translations' => [
                        'hy' => 'Հաճախականության փոխարկիչ',
                        'en' => 'Variable Speed Drive',
                        'ru' => 'Частотный преобразователь',
                    ]],
                    ['code' => 'automatic_transfer_switch', 'translations' => [
                        'hy' => 'Ավտոմատ ռեզերվի մուտք',
                        'en' => 'Automatic Transfer Switch',
                        'ru' => 'Автоматический ввод резерва',
                    ]],
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | TECHNICAL ATTRIBUTES
            |--------------------------------------------------------------------------
            */

            'motor_power_kw' => [
                'type' => 'float',
                'translations' => [
                    'hy' => 'Շարժիչի հզորություն (կՎտ)',
                    'en' => 'Motor Power (kW)',
                    'ru' => 'Мощность двигателя (кВт)',
                ],
            ],

            'motor_power_hp' => [
                'type' => 'float',
                'translations' => [
                    'hy' => 'Շարժիչի հզորություն (hp)',
                    'en' => 'Motor Power (hp)',
                    'ru' => 'Мощность двигателя (л.с.)',
                ],
            ],

            'supply_voltage' => [
                'type' => 'string',
                'translations' => [
                    'hy' => 'Լարման մատակարարում',
                    'en' => 'Supply Voltage',
                    'ru' => 'Напряжение питания',
                ],
            ],

            'phases' => [
                'type' => 'integer',
                'translations' => [
                    'hy' => 'Փուլերի քանակ',
                    'en' => 'Number of Phases',
                    'ru' => 'Количество фаз',
                ],
            ],

            'supply_frequency' => [
                'type' => 'string',
                'translations' => [
                    'hy' => 'Հաճախականություն',
                    'en' => 'Frequency',
                    'ru' => 'Частота',
                ],
            ],

            'communication_protocol' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Կապի արձանագրություն',
                    'en' => 'Communication Protocol',
                    'ru' => 'Протокол связи',
                ],
                'values' => [
                    ['code' => 'modbus', 'translations' => [
                        'hy' => 'Modbus',
                        'en' => 'Modbus',
                        'ru' => 'Modbus',
                    ]],
                ],
            ],

            'cooling_type' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Սառեցման տեսակ',
                    'en' => 'Cooling Type',
                    'ru' => 'Тип охлаждения',
                ],
                'values' => [
                    ['code' => 'fan', 'translations' => [
                        'hy' => 'Օդային (Fan)',
                        'en' => 'Fan',
                        'ru' => 'Вентилятор',
                    ]],
                ],
            ],

            'ip_rating' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Պաշտպանության աստիճան',
                    'en' => 'IP Rating',
                    'ru' => 'Степень защиты',
                ],
                'values' => [
                    ['code' => 'ip20', 'translations' => [
                        'hy' => 'IP20',
                        'en' => 'IP20',
                        'ru' => 'IP20',
                    ]],
                ],
            ],

            'width_mm' => [
                'type' => 'integer',
                'translations' => [
                    'hy' => 'Լայնություն (մմ)',
                    'en' => 'Width (mm)',
                    'ru' => 'Ширина (мм)',
                ],
            ],

            'height_mm' => [
                'type' => 'integer',
                'translations' => [
                    'hy' => 'Բարձրություն (մմ)',
                    'en' => 'Height (mm)',
                    'ru' => 'Высота (мм)',
                ],
            ],

            'depth_mm' => [
                'type' => 'float',
                'translations' => [
                    'hy' => 'Խորություն (մմ)',
                    'en' => 'Depth (mm)',
                    'ru' => 'Глубина (мм)',
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
                    [
                        'attribute_id' => $attribute->id,
                        'locale' => $locale,
                    ],
                    ['name' => $name]
                );
            }

            if (!empty($data['values'])) {
                foreach ($data['values'] as $val) {
                    $value = AttributeValue::updateOrCreate(
                        [
                            'attribute_id' => $attribute->id,
                            'code' => $val['code'],
                        ],
                        []
                    );

                    foreach ($val['translations'] as $locale => $valueName) {
                        AttributeValueTranslation::updateOrCreate(
                            [
                                'attribute_value_id' => $value->id,
                                'locale' => $locale,
                            ],
                            ['name' => $valueName]
                        );
                    }
                }
            }
        }
    }
}
