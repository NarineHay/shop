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
            |----------------------------------------------------------------------
            | COMMERCIAL ATTRIBUTES
            |----------------------------------------------------------------------
            */

            'color' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Գույն',
                    'en' => 'Color',
                    'ru' => 'Цвет',
                ],
                'values' => [
                    ['code' => 'black', 'translations' => ['hy'=>'Սև','en'=>'Black','ru'=>'Чёрный']],
                    ['code' => 'white', 'translations' => ['hy'=>'Սպիտակ','en'=>'White','ru'=>'Белый']],
                    ['code' => 'grey', 'translations' => ['hy'=>'Մոխրագույն','en'=>'Grey','ru'=>'Серый']],
                    ['code' => 'blue', 'translations' => ['hy'=>'Կապույտ','en'=>'Blue','ru'=>'Синий']],
                    ['code' => 'yellow', 'translations' => ['hy'=>'Դեղին','en'=>'Yellow','ru'=>'Желтый']],
                    ['code' => 'green', 'translations' => ['hy'=>'Կանաչ','en'=>'Green','ru'=>'Зеленый']],
                    ['code' => 'red', 'translations' => ['hy'=>'Կարմիր','en'=>'Red','ru'=>'Красный']],


                ],
            ],

            'product_type' => [
                'type' => 'select',
                'translations' => ['hy'=>'Ապրանքի տեսակ','en'=>'Product Type','ru'=>'Тип товара'],
                'values' => [
                    ['code'=>'variable_speed_drive','translations'=>['hy'=>'Հաճախականության փոխարկիչ','en'=>'Variable Speed Drive','ru'=>'Частотный преобразователь']],
                    ['code'=>'automatic_transfer_switch','translations'=>['hy'=>'Ավտոմատ ռեզերվի մուտք','en'=>'Automatic Transfer Switch','ru'=>'Автоматический ввод резерва']],
                ],
            ],

            /*
            |----------------------------------------------------------------------
            | TECHNICAL ATTRIBUTES
            |----------------------------------------------------------------------
            */

            'motor_power_kw' => [
                'type' => 'select',
                'translations' => ['hy'=>'Շարժիչի հզորություն (կՎտ)','en'=>'Motor Power (kW)','ru'=>'Мощность двигателя (кВт)'],
                'values' => [
                    ['code'=>'0.75','translations'=>['hy'=>'0.75','en'=>'0.75','ru'=>'0.75']],
                    ['code'=>'1.5','translations'=>['hy'=>'1.5','en'=>'1.5','ru'=>'1.5']],
                    ['code'=>'2.2','translations'=>['hy'=>'2.2','en'=>'2.2','ru'=>'2.2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                    ['code'=>'4','translations'=>['hy'=>'4','en'=>'4','ru'=>'4']],
                    ['code'=>'5.5','translations'=>['hy'=>'5.5','en'=>'5.5','ru'=>'5.5']],
                    ['code'=>'7.5','translations'=>['hy'=>'7.5','en'=>'7.5','ru'=>'7.5']],
                    ['code'=>'11','translations'=>['hy'=>'11','en'=>'11','ru'=>'11']],
                    ['code'=>'15','translations'=>['hy'=>'15','en'=>'15','ru'=>'15']],
                    ['code'=>'18.5','translations'=>['hy'=>'18.5','en'=>'18.5','ru'=>'18.5']],
                    ['code'=>'22','translations'=>['hy'=>'22','en'=>'22','ru'=>'22']],
                    ['code'=>'30','translations'=>['hy'=>'30','en'=>'30','ru'=>'30']],
                    ['code'=>'37','translations'=>['hy'=>'37','en'=>'37','ru'=>'37']],
                    ['code'=>'45','translations'=>['hy'=>'45','en'=>'45','ru'=>'45']],
                    ['code'=>'55','translations'=>['hy'=>'55','en'=>'55','ru'=>'55']],
                    ['code'=>'75','translations'=>['hy'=>'75','en'=>'75','ru'=>'75']],

                    // добавь остальные значения
                ],
            ],

            'motor_power_hp' => [
                'type' => 'select',
                'translations' => ['hy'=>'Շարժիչի հզորություն (hp)','en'=>'Motor Power (hp)','ru'=>'Мощность двигателя (л.с.)'],
                'values' => [
                    ['code'=>'1','translations'=>['hy'=>'1','en'=>'1','ru'=>'1']],
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                    // добавь остальные значения
                ],
            ],

            'supply_voltage' => [
                'type' => 'select',
                'translations' => ['hy'=>'Լարման մատակարարում','en'=>'Supply Voltage','ru'=>'Напряжение питания'],
                'values' => [
                    ['code'=>'12','translations'=>['hy'=>'12','en'=>'12','ru'=>'12']],
                    ['code'=>'24','translations'=>['hy'=>'24','en'=>'24','ru'=>'24']],
                    ['code'=>'220V','translations'=>['hy'=>'220V','en'=>'220V','ru'=>'220V']],
                    ['code'=>'230V','translations'=>['hy'=>'230V','en'=>'230V','ru'=>'230V']],
                    ['code'=>'200-240V','translations'=>['hy'=>'200-240V','en'=>'200-240V','ru'=>'200-240V']],
                    ['code'=>'380V','translations'=>['hy'=>'380V','en'=>'380V','ru'=>'380V']],
                    ['code'=>'380-440V','translations'=>['hy'=>'380-440V','en'=>'380-440V','ru'=>'380-440V']],
                    ['code'=>'440','translations'=>['hy'=>'440','en'=>'440','ru'=>'440']],

                ],
            ],

            'current_rating' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ամպերաժ',
                    'en' => 'Current Rating',
                    'ru' => 'Ампераж',
                ],
                'values' => [
                    ['code'=>'10', 'translations'=>['hy'=>'10','en'=>'10','ru'=>'10']],
                    ['code'=>'16', 'translations'=>['hy'=>'16','en'=>'16','ru'=>'16']],
                    ['code'=>'20', 'translations'=>['hy'=>'20','en'=>'20','ru'=>'20']],
                    ['code'=>'25', 'translations'=>['hy'=>'25A','en'=>'25A','ru'=>'25A']],
                    ['code'=>'40', 'translations'=>['hy'=>'40A','en'=>'40A','ru'=>'40A']],
                    ['code'=>'56', 'translations'=>['hy'=>'56A','en'=>'56A','ru'=>'56A']],
                    ['code'=>'60', 'translations'=>['hy'=>'60A','en'=>'60A','ru'=>'60A']],
                    ['code'=>'80', 'translations'=>['hy'=>'80A','en'=>'80A','ru'=>'80A']],
                    ['code'=>'100', 'translations'=>['hy'=>'100','en'=>'100','ru'=>'100']],
                    ['code'=>'120', 'translations'=>['hy'=>'120A','en'=>'120A','ru'=>'120A']],
                    ['code'=>'125', 'translations'=>['hy'=>'125','en'=>'125','ru'=>'125']],
                    ['code'=>'160', 'translations'=>['hy'=>'160A','en'=>'160A','ru'=>'160A']],
                    ['code'=>'185', 'translations'=>['hy'=>'185A','en'=>'185A','ru'=>'185A']],
                    ['code'=>'200', 'translations'=>['hy'=>'200A','en'=>'200A','ru'=>'200A']],
                    ['code'=>'225', 'translations'=>['hy'=>'225A','en'=>'225A','ru'=>'225A']],
                    ['code'=>'250', 'translations'=>['hy'=>'250A','en'=>'250A','ru'=>'250A']],
                    ['code'=>'330', 'translations'=>['hy'=>'330A','en'=>'330A','ru'=>'330A']],
                    ['code'=>'400', 'translations'=>['hy'=>'400A','en'=>'400A','ru'=>'400A']],
                    ['code'=>'630', 'translations'=>['hy'=>'630A','en'=>'630A','ru'=>'630A']],
                    ['code'=>'800', 'translations'=>['hy'=>'800A','en'=>'800A','ru'=>'800A']],
                ],
            ],

            'phases' => [
                'type' => 'select',
                'translations' => ['hy'=>'Փուլերի քանակ','en'=>'Number of Phases','ru'=>'Количество фаз'],
                'values' => [
                    ['code'=>'1','translations'=>['hy'=>'1','en'=>'1','ru'=>'1']],
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                ],
            ],

            'supply_frequency' => [
                'type' => 'select',
                'translations' => ['hy'=>'Հաճախականություն','en'=>'Frequency','ru'=>'Частота'],
                'values' => [
                    ['code'=>'50Hz','translations'=>['hy'=>'50Hz','en'=>'50Hz','ru'=>'50Hz']],
                    ['code'=>'60Hz','translations'=>['hy'=>'60Hz','en'=>'60Hz','ru'=>'60Hz']],
                ],
            ],

            'communication_protocol' => [
                'type' => 'select',
                'translations' => ['hy'=>'Կապի արձանագրություն','en'=>'Communication Protocol','ru'=>'Протокол связи'],
                'values' => [
                    ['code'=>'modbus','translations'=>['hy'=>'Modbus','en'=>'Modbus','ru'=>'Modbus']],
                    ['code'=>'profibus','translations'=>['hy'=>'Profibus','en'=>'Profibus','ru'=>'Profibus']],
                ],
            ],

            'cooling_type' => [
                'type' => 'select',
                'translations' => ['hy'=>'Սառեցման տեսակ','en'=>'Cooling Type','ru'=>'Тип охлаждения'],
                'values' => [
                    ['code'=>'fan','translations'=>['hy'=>'Օդային (Fan)','en'=>'Fan','ru'=>'Вентилятор']],
                    ['code'=>'liquid','translations'=>['hy'=>'Ջրային','en'=>'Liquid','ru'=>'Жидкостное']],
                ],
            ],

            'ip_rating' => [
                'type' => 'select',
                'translations' => ['hy'=>'Պաշտպանության աստիճան','en'=>'IP Rating','ru'=>'Степень защиты'],
                'values' => [
                    ['code'=>'ip20','translations'=>['hy'=>'IP20','en'=>'IP20','ru'=>'IP20']],
                    ['code'=>'ip44','translations'=>['hy'=>'IP44','en'=>'IP44','ru'=>'IP44']],
                    ['code'=>'ip67','translations'=>['hy'=>'IP67','en'=>'IP67','ru'=>'IP67']],
                ],
            ],

            'width_mm' => [
                'type' => 'select',
                'translations' => ['hy'=>'Լայնություն (մմ)','en'=>'Width (mm)','ru'=>'Ширина (мм)'],
                'values' => [
                    ['code'=>'22','translations'=>['hy'=>'22','en'=>'22','ru'=>'22']],
                    ['code'=>'27','translations'=>['hy'=>'27','en'=>'27','ru'=>'27']],
                    ['code'=>'30','translations'=>['hy'=>'30','en'=>'30','ru'=>'30']],
                    ['code'=>'40','translations'=>['hy'=>'40','en'=>'40','ru'=>'40']],
                ],
            ],

            'height_mm' => [
                'type' => 'select',
                'translations' => ['hy'=>'Բարձրություն (մմ)','en'=>'Height (mm)','ru'=>'Высота (мм)'],
                'values' => [
                    ['code'=>'100','translations'=>['hy'=>'100','en'=>'100','ru'=>'100']],
                    ['code'=>'150','translations'=>['hy'=>'150','en'=>'150','ru'=>'150']],
                    ['code'=>'200','translations'=>['hy'=>'200','en'=>'200','ru'=>'200']],
                ],
            ],

            'depth_mm' => [
                'type' => 'select',
                'translations' => ['hy'=>'Խորություն (մմ)','en'=>'Depth (mm)','ru'=>'Глубина (мм)'],
                'values' => [
                    ['code'=>'50','translations'=>['hy'=>'50','en'=>'50','ru'=>'50']],
                    ['code'=>'60','translations'=>['hy'=>'60','en'=>'60','ru'=>'60']],
                    ['code'=>'70','translations'=>['hy'=>'70','en'=>'70','ru'=>'70']],
                ],
            ],

        ];

        foreach ($attributes as $slug => $data) {
            $attribute = Attribute::updateOrCreate(
                ['slug' => $slug],
                ['type' => 'select'] // все атрибуты делаем select
            );

            foreach ($data['translations'] as $locale => $name) {
                AttributeTranslation::updateOrCreate(
                    ['attribute_id' => $attribute->id,'locale'=>$locale],
                    ['name' => $name]
                );
            }

            if (!empty($data['values'])) {
                foreach ($data['values'] as $val) {
                    $value = AttributeValue::updateOrCreate(
                        ['attribute_id'=>$attribute->id,'code'=>$val['code']],
                        []
                    );

                    foreach ($val['translations'] as $locale => $valueName) {
                        AttributeValueTranslation::updateOrCreate(
                            ['attribute_value_id'=>$value->id,'locale'=>$locale],
                            ['name'=>$valueName]
                        );
                    }
                }
            }
        }
    }
}
