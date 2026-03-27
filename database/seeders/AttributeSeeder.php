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
            // ***
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



            /*
            |----------------------------------------------------------------------
            | TECHNICAL ATTRIBUTES
            |----------------------------------------------------------------------
            */
            // ***
            'power_kva' => [
                'type' => 'select',
                'translations' => ['hy' => 'Հզորություն (kVA)','en' => 'Power (kVA)','ru' => 'Мощность (кВА)'],
                'values' => [
                    ['code'=>'1','translations'=>['hy'=>'1 kVA','en'=>'1 kVA','ru'=>'1 кВА']],
                    ['code'=>'1_5','translations'=>['hy'=>'1.5 kVA','en'=>'1.5 kVA','ru'=>'1.5 кВА']],
                    ['code'=>'3','translations'=>['hy'=>'3 kVA','en'=>'3 kVA','ru'=>'3 кВА']],
                    ['code'=>'5','translations'=>['hy'=>'5 kVA','en'=>'5 kVA','ru'=>'5 кВА']],
                    ['code'=>'6','translations'=>['hy'=>'6 kVA','en'=>'6 kVA','ru'=>'6 кВА']],
                    ['code'=>'7','translations'=>['hy'=>'7 kVA','en'=>'7 kVA','ru'=>'7 кВА']],
                    ['code'=>'9','translations'=>['hy'=>'9 kVA','en'=>'9 kVA','ru'=>'9 кВА']],
                    ['code'=>'10','translations'=>['hy'=>'10 kVA','en'=>'10 kVA','ru'=>'10 кВА']],
                    ['code'=>'15','translations'=>['hy'=>'15 kVA','en'=>'15 kVA','ru'=>'15 кВА']],
                    ['code'=>'20','translations'=>['hy'=>'20 kVA','en'=>'20 kVA','ru'=>'20 кВА']],
                    ['code'=>'30','translations'=>['hy'=>'30 kVA','en'=>'30 kVA','ru'=>'30 кВА']],
                    ['code'=>'45','translations'=>['hy'=>'45 kVA','en'=>'45 kVA','ru'=>'45 кВА']],
                    ['code'=>'60','translations'=>['hy'=>'60 kVA','en'=>'60 kVA','ru'=>'60 кВА']],

                    // добавь остальные значения
                ],
            ],


             // ***
             'power_kw' => [
                'type' => 'select',
                'translations' => ['hy' => 'Հզորություն (կՎտ)','en' => 'Power (kW)','ru' => 'Мощность (кВт)'],
                'values' => [
                    ['code'=>'0_75','translations'=>['hy'=>'0.75 կՎտ','en'=>'0.75 kW','ru'=>'0.75 кВт']],
                    ['code'=>'1_5','translations'=>['hy'=>'1.5 կՎտ','en'=>'1.5 kW','ru'=>'1.5 кВт']],
                    ['code'=>'2_2','translations'=>['hy'=>'2.2 կՎտ','en'=>'2.2 kW','ru'=>'2.2 кВт']],
                    ['code'=>'4','translations'=>['hy'=>'4 կՎտ','en'=>'4 kW','ru'=>'4 кВт']],
                    ['code'=>'5_5','translations'=>['hy'=>'5.5 կՎտ','en'=>'5.5 kW','ru'=>'5.5 кВт']],
                    ['code'=>'7_5','translations'=>['hy'=>'7.5 կՎտ','en'=>'7.5 kW','ru'=>'7.5 кВт']],
                    ['code'=>'11','translations'=>['hy'=>'11 կՎտ','en'=>'11 kW','ru'=>'11 кВт']],
                    ['code'=>'15','translations'=>['hy'=>'15 կՎտ','en'=>'15 kW','ru'=>'15 кВт']],
                    ['code'=>'18_5','translations'=>['hy'=>'18.5 կՎտ','en'=>'18.5 kW','ru'=>'18.5 кВт']],
                    ['code'=>'22','translations'=>['hy'=>'22 կՎտ','en'=>'22 kW','ru'=>'22 кВт']],
                    ['code'=>'30','translations'=>['hy'=>'30 կՎտ','en'=>'30 kW','ru'=>'30 кВт']],
                    ['code'=>'35','translations'=>['hy'=>'35 կՎտ','en'=>'35 kW','ru'=>'35 кВт']],
                    ['code'=>'37','translations'=>['hy'=>'37 կՎտ','en'=>'37 kW','ru'=>'37 кВт']],
                    ['code'=>'45','translations'=>['hy'=>'45 կՎտ','en'=>'45 kW','ru'=>'45 кВт']],
                    ['code'=>'50','translations'=>['hy'=>'50 կՎտ','en'=>'50 kW','ru'=>'50 кВт']],
                    ['code'=>'55','translations'=>['hy'=>'55 կՎտ','en'=>'55 kW','ru'=>'55 кВт']],
                    ['code'=>'75','translations'=>['hy'=>'75 կՎտ','en'=>'75 kW','ru'=>'75 кВт']],
                    ['code'=>'100','translations'=>['hy'=>'100 կՎտ','en'=>'100 kW','ru'=>'100 кВт']],
                    ['code'=>'120','translations'=>['hy'=>'120 կՎտ','en'=>'120 kW','ru'=>'120 кВт']],
                    ['code'=>'150','translations'=>['hy'=>'150 կՎտ','en'=>'150 kW','ru'=>'150 кВт']],
                    ['code'=>'200','translations'=>['hy'=>'200 կՎտ','en'=>'200 kW','ru'=>'200 кВт']],
                    ['code'=>'240','translations'=>['hy'=>'240 կՎտ','en'=>'240 kW','ru'=>'240 кВт']],

                ],
            ],


            'power_w' => [
                'type' => 'select',
                'translations' => ['hy' => 'Հզորություն (W)', 'en' => 'Power (W)', 'ru' => 'Мощность (Вт)'],
                'values' => [
                    ['code' => '35', 'translations' => ['hy' => '35 W', 'en' => '35 W', 'ru' => '35 Вт']],
                    ['code' => '50', 'translations' => ['hy' => '50 W', 'en' => '50 W', 'ru' => '50 Вт']],
                    ['code' => '75', 'translations' => ['hy' => '75 W', 'en' => '75 W', 'ru' => '75 Вт']],
                    ['code' => '100', 'translations' => ['hy' => '100 W', 'en' => '100 W', 'ru' => '100 Вт']],
                    ['code' => '120', 'translations' => ['hy' => '120 W', 'en' => '120 W', 'ru' => '120 Вт']],
                    ['code' => '150', 'translations' => ['hy' => '150 W', 'en' => '150 W', 'ru' => '150 Вт']],
                    ['code' => '200', 'translations' => ['hy' => '200 W', 'en' => '200 W', 'ru' => '200 Вт']],
                    ['code' => '240', 'translations' => ['hy' => '240 W', 'en' => '240 W', 'ru' => '240 Вт']]
                ],
            ],


            // ***
            'number_of_ways' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Տեղերի քանակ',
                    'en' => 'Number of ways',
                    'ru' => 'Число мест'
                ],
                'values' => [
                    ['code' => '1', 'translations' => ['hy' => '1 տեղ', 'en' => '1 seat', 'ru' => '1 место']],
                    ['code' => '2', 'translations' => ['hy' => '2 տեղ', 'en' => '2 seats', 'ru' => '2 места']],
                    ['code' => '4', 'translations' => ['hy' => '4 տեղ', 'en' => '4 seats', 'ru' => '4 места']],
                    ['code' => '6', 'translations' => ['hy' => '6 տեղ', 'en' => '6 seats', 'ru' => '6 мест']],
                    ['code' => '8', 'translations' => ['hy' => '8 տեղ', 'en' => '8 seats', 'ru' => '8 мест']],
                    ['code' => '10', 'translations' => ['hy' => '10 տեղ', 'en' => '10 seats', 'ru' => '10 мест']],
                    ['code' => '11', 'translations' => ['hy' => '11 տեղ', 'en' => '11 seats', 'ru' => '11 мест']],
                    ['code' => '12', 'translations' => ['hy' => '12 տեղ', 'en' => '12 seats', 'ru' => '12 мест']],
                    ['code' => '14', 'translations' => ['hy' => '14 տեղ', 'en' => '14 seats', 'ru' => '14 мест']],
                    ['code' => '16', 'translations' => ['hy' => '16 տեղ', 'en' => '16 seats', 'ru' => '16 мест']],
                    ['code' => '18', 'translations' => ['hy' => '18 տեղ', 'en' => '18 seats', 'ru' => '18 мест']],
                    ['code' => '20', 'translations' => ['hy' => '20 տեղ', 'en' => '20 seats', 'ru' => '20 мест']],
                    ['code' => '24', 'translations' => ['hy' => '24 տեղ', 'en' => '24 seats', 'ru' => '24 мест']],
                    ['code' => '25', 'translations' => ['hy' => '25 տեղ', 'en' => '25 seats', 'ru' => '25 мест']],
                    ['code' => '30', 'translations' => ['hy' => '30 տեղ', 'en' => '30 seats', 'ru' => '30 мест']],
                    ['code' => '36', 'translations' => ['hy' => '36 տեղ', 'en' => '36 seats', 'ru' => '36 мест']],

                    // добавь остальные значения по потребности
                ],
            ],

            // ***
            'installation_type' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Տեղադրման ձևը',
                    'en' => 'Installation type',
                    'ru' => 'Тип установки',
                ],
                'values' => [
                    [
                        'code' => 'surface',
                        'translations' => [
                            'hy' => 'Արտաքին',
                            'en' => 'Surface',
                            'ru' => 'Навесной',
                        ],
                    ],
                    [
                        'code' => 'flush',
                        'translations' => [
                            'hy' => 'Ներքին',
                            'en' => 'Flush',
                            'ru' => 'Встраиваемый',
                        ],
                    ],
                ],
            ],


            'installation_place' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Տեղադրման տեղը',
                    'en' => 'Instalation place',
                    'ru' => 'Место установки',
                ],
                'values' => [
                    [
                        'code' => 'surface',
                        'translations' => [
                            'hy' => 'Արտաքին',
                            'en' => 'Surface',
                            'ru' => 'Навесной',
                        ],
                    ],
                    [
                        'code' => 'din_rail',
                        'translations' => [
                            'hy' => 'DIN ռելս',
                            'en' => 'DIN rail',
                            'ru' => 'DIN-рейка',
                        ],
                    ],
                ],
            ],


            // ***
            'fire_safety' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Հրդեհային անվտանգություն',
                    'en' => 'Fire safety',
                    'ru' => 'Пожаробезопасность',
                ],
                'values' => [
                    [
                        'code' => 'regular',
                        'translations' => [
                            'hy' => 'Սովորական',
                            'en' => 'Regular',
                            'ru' => 'Стандртный',
                        ],
                    ],
                    [
                        'code' => 'flame_retardant',
                        'translations' => [
                            'hy' => 'Հրակայուն',
                            'en' => 'Flame retardant',
                            'ru' => 'Огнестойкий',
                        ],
                    ],
                ],
            ],

            // ***
            'configuration' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Կառուցվածք',
                    'en' => 'Configuration',
                    'ru' => 'Конфигурация',
                ],
                'values' => [
                    [
                        'code' => 'metallic',
                        'translations' => [
                            'hy' => 'Մետաղական',
                            'en' => 'Metallic',
                            'ru' => 'Металлический',
                        ],
                    ],
                    [
                        'code' => 'non-metallic',
                        'translations' => [
                            'hy' => 'Ոչ մետաղական',
                            'en' => 'Non-metallic',
                            'ru' => 'Неметаллический',
                        ],
                    ],
                ],
            ],


            // ***
            'current' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Հոսանքի ուժ',
                    'en' => 'Current (A)',
                    'ru' => 'Сила тока (А)',
                ],
                'values' => [
                    ['code' => '0_1-0_16', 'translations' => ['hy' => '0.1-0.16 A', 'en' => '0.1-0.16 A', 'ru' => '0.1-0.16 А']],
                    ['code' => '0_16-0_25', 'translations' => ['hy' => '0.16-0.25 A', 'en' => '0.16-0.25 A', 'ru' => '0.16-0.25 А']],
                    ['code' => '0_25-0_4', 'translations' => ['hy' => '0.25-0.4 A', 'en' => '0.25-0.4 A', 'ru' => '0.25-0.4 А']],
                    ['code' => '0_4-0_6', 'translations' => ['hy' => '0.4-0.6 A', 'en' => '0.4-0.6 A', 'ru' => '0.4-0.6 А']],
                    ['code' => '0_4-0_63', 'translations' => ['hy' => '0.4-0.63 A', 'en' => '0.4-0.63 A', 'ru' => '0.4-0.63 А']],
                    ['code' => '0_63-1', 'translations' => ['hy' => '0.63-1 A', 'en' => '0.63-1 A', 'ru' => '0.63-1 А']],
                    ['code' => '1-1_6', 'translations' => ['hy' => '1-1.6 A', 'en' => '1-1.6 A', 'ru' => '1-1.6 А']],
                    ['code' => '1_6-2_5', 'translations' => ['hy' => '1.6-2.5 A', 'en' => '1.6-2.5 A', 'ru' => '1.6-2.5 А']],
                    ['code' => '2_5-4', 'translations' => ['hy' => '2.5-4 A', 'en' => '2.5-4 A', 'ru' => '2.5-4 А']],
                    ['code' => '4-6', 'translations' => ['hy' => '4-6 A', 'en' => '4-6 A', 'ru' => '4-6 А']],
                    ['code' => '4-6_3', 'translations' => ['hy' => '4-6.3 A', 'en' => '4-6.3 A', 'ru' => '4-6.3 А']],
                    ['code' => '5_5-8', 'translations' => ['hy' => '5.5-8 A', 'en' => '5.5-8 A', 'ru' => '5.5-8 А']],
                    ['code' => '6-10', 'translations' => ['hy' => '6-10 A', 'en' => '6-10 A', 'ru' => '6-10 А']],
                    ['code' => '7-10', 'translations' => ['hy' => '7-10 A', 'en' => '7-10 A', 'ru' => '7-10 А']],
                    ['code' => '9-13', 'translations' => ['hy' => '9-13 A', 'en' => '9-13 A', 'ru' => '9-13 А']],
                    ['code' => '9-14', 'translations' => ['hy' => '9-14 A', 'en' => '9-14 A', 'ru' => '9-14 А']],
                    ['code' => '9-38', 'translations' => ['hy' => '9-38 A', 'en' => '9-38 A', 'ru' => '9-38 А']],
                    ['code' => '12-18', 'translations' => ['hy' => '12-18 A', 'en' => '12-18 A', 'ru' => '12-18 А']],
                    ['code' => '13-18', 'translations' => ['hy' => '13-18 A', 'en' => '13-18 A', 'ru' => '13-18 А']],
                    ['code' => '17-23', 'translations' => ['hy' => '17-23 A', 'en' => '17-23 A', 'ru' => '17-23 А']],
                    ['code' => '17-25', 'translations' => ['hy' => '17-25 A', 'en' => '17-25 A', 'ru' => '17-25 А']],
                    ['code' => '20-25', 'translations' => ['hy' => '20-25 A', 'en' => '20-25 A', 'ru' => '20-25 А']],
                    ['code' => '24-32', 'translations' => ['hy' => '24-32 A', 'en' => '24-32 A', 'ru' => '24-32 А']],
                    ['code' => '25-40', 'translations' => ['hy' => '25-40 A', 'en' => '25-40 A', 'ru' => '25-40 А']],
                    ['code' => '40-60', 'translations' => ['hy' => '40-60 A', 'en' => '40-60 A', 'ru' => '40-60 А']],
                    ['code' => '40-95', 'translations' => ['hy' => '40-95 A','en' => '40-95 A','ru' => '40-95 А']],
                    ['code' => '56-80', 'translations' => ['hy' => '56-80 A', 'en' => '56-80 A', 'ru' => '56-80 А']],
                    ['code' => '9',  'translations' => ['hy' => '9 A',  'en' => '9 A',  'ru' => '9 А']],
                    ['code' => '10',  'translations' => ['hy' => '10 A',  'en' => '10 A',  'ru' => '10 А']],
                    ['code' => '12', 'translations' => ['hy' => '12 A', 'en' => '12 A', 'ru' => '12 А']],
                    ['code' => '16', 'translations' => ['hy' => '16 A', 'en' => '16 A', 'ru' => '16 А']],
                    ['code' => '18', 'translations' => ['hy' => '18 A', 'en' => '18 A', 'ru' => '18 А']],
                    ['code' => '20', 'translations' => ['hy' => '20 A', 'en' => '20 A', 'ru' => '20 А']],
                    ['code' => '24', 'translations' => ['hy' => '24 A', 'en' => '24 A', 'ru' => '24 А']],
                    ['code' => '25', 'translations' => ['hy' => '25 A', 'en' => '25 A', 'ru' => '25 А']],
                    ['code' => '32', 'translations' => ['hy' => '32 A', 'en' => '32 A', 'ru' => '32 А']],
                    ['code' => '38', 'translations' => ['hy' => '38 A', 'en' => '38 A', 'ru' => '38 А']],
                    ['code' => '40', 'translations' => ['hy' => '40 A', 'en' => '40 A', 'ru' => '40 А']],
                    ['code' => '50', 'translations' => ['hy' => '50 A', 'en' => '50 A', 'ru' => '50 А']],
                    ['code' => '63', 'translations' => ['hy' => '63 A', 'en' => '63 A', 'ru' => '63 А']],
                    ['code' => '65', 'translations' => ['hy' => '65 A', 'en' => '65 A', 'ru' => '65 А']],
                    ['code' => '80', 'translations' => ['hy' => '80 A', 'en' => '80 A', 'ru' => '80 А']],
                    ['code' => '100', 'translations' => ['hy' => '100 A', 'en' => '100 A', 'ru' => '100 А']],
                    ['code' => '120', 'translations' => ['hy' => '120 A', 'en' => '120 A', 'ru' => '120 А']],
                    ['code' => '125', 'translations' => ['hy' => '125 A', 'en' => '125 A', 'ru' => '125 А']],
                    ['code' => '160', 'translations' => ['hy' => '160 A', 'en' => '160 A', 'ru' => '160 А']],
                    ['code' => '185', 'translations' => ['hy' => '185 A', 'en' => '185 A', 'ru' => '185 А']],
                    ['code' => '200', 'translations' => ['hy' => '200 A', 'en' => '200 A', 'ru' => '200 А']],
                    ['code' => '225', 'translations' => ['hy' => '225 A', 'en' => '225 A', 'ru' => '225 А']],
                    ['code' => '240', 'translations' => ['hy' => '240 A', 'en' => '240 A', 'ru' => '240 А']],
                    ['code' => '250', 'translations' => ['hy' => '250 A', 'en' => '250 A', 'ru' => '250 А']],
                    ['code' => '265', 'translations' => ['hy' => '265 A', 'en' => '265 A', 'ru' => '265 А']],
                    ['code' => '330', 'translations' => ['hy' => '330 A', 'en' => '330 A', 'ru' => '330 А']],
                    ['code' => '400', 'translations' => ['hy' => '400 A', 'en' => '400 A', 'ru' => '400 А']],
                    ['code' => '630', 'translations' => ['hy' => '630 A', 'en' => '630 A', 'ru' => '630 А']],
                    ['code' => '800', 'translations' => ['hy' => '800 A', 'en' => '800 A', 'ru' => '800 А']],

                ],
            ],


            // ***
            'time_delay_range' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ժամանակի ուշացման միջակայք',
                    'en' => 'Time delay range',
                    'ru' => 'Диапазон задержки времени',
                ],
                'values' => [
                    ['code'=>'0_1','translations'=>['hy'=>'0.1 վրկ','en'=>'0.1 sec','ru'=>'0.1 сек']],
                    ['code'=>'0_1-3','translations'=>['hy'=>'0.1-3 վրկ','en'=>'0.1-3 sec','ru'=>'0.1-3 сек']],
                    ['code'=>'1-3','translations'=>['hy'=>'1-3 վրկ','en'=>'1-3 sec','ru'=>'1-3 сек']],
                    ['code'=>'10-180','translations'=>['hy'=>'10-180 վրկ','en'=>'10-180 sec','ru'=>'10-180 сек']],
                    ['code'=>'0_1-30','translations'=>['hy'=>'0.1-30 վրկ','en'=>'0.1-30 sec','ru'=>'0.1-30 сек']],
                ],
            ],


            // ***
            'number_of_phases' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ֆազերի քանակ',
                    'en' => 'Number of phases',
                    'ru' => 'Количество фаз',
                ],
                'values' => [
                    ['code'=>'1-3','translations'=>['hy'=>'1 ֆազ-3 ֆազ','en'=>'1 phase-3 phases','ru'=>'1 фаза-3 фазы']],
                    ['code'=>'3-3','translations'=>['hy'=>'3 ֆազ-3 ֆազ','en'=>'3 phases-3 phases','ru'=>'3 фазы-3 фазы']],
                    ['code'=>'2','translations'=>['hy'=>'2 ֆազ','en'=>'2 phases','ru'=>'2 фазы']],
                    ['code'=>'3','translations'=>['hy'=>'3 ֆազ','en'=>'3 phases','ru'=>'3 фазы']],
                    ['code'=>'4','translations'=>['hy'=>'4 ֆազ','en'=>'4 phases','ru'=>'4 фазы']],

                ],
            ],


            // ***
            'voltage' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Լարում',
                    'en' => 'Voltage',
                    'ru' => 'Напряжение',
                ],
                'values' => [
                    ['code'=>'12','translations'=>['hy'=>'12 V','en'=>'12 V','ru'=>'12 В']],
                    ['code'=>'24','translations'=>['hy'=>'24 V','en'=>'24 V','ru'=>'24 В']],
                    ['code'=>'220','translations'=>['hy'=>'220 V','en'=>'220 V','ru'=>'220 В']],
                    ['code'=>'230','translations'=>['hy'=>'230 V','en'=>'230 V','ru'=>'230 В']],
                    ['code'=>'240','translations'=>['hy'=>'240 V','en'=>'240 V','ru'=>'240 В']],
                    ['code'=>'380','translations'=>['hy'=>'380 V','en'=>'380 V','ru'=>'380 В']],
                ],
            ],


            // ***

            'number_of_cut_out' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Անցքերի քանակ',
                    'en' => 'Number of cut-out',
                    'ru' => 'Количество вырезов',
                ],
                'values' => [
                    ['code'=>'1','translations'=>['hy'=>'1','en'=>'1','ru'=>'1']],
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                    ['code'=>'4','translations'=>['hy'=>'4','en'=>'4','ru'=>'4']],
                ],
            ],

            // ***

            'diameter_of_cut_out' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Անցքի տրամագիծ',
                    'en' => 'Diameter of cut-out',
                    'ru' => 'Диаметр выреза',
                ],
                'values' => [
                    ['code'=>'22','translations'=>['hy'=>'22 մմ','en'=>'22 mm','ru'=>'22 мм']],
                    ['code'=>'30','translations'=>['hy'=>'30 մմ','en'=>'30 mm','ru'=>'30 мм']],
                ],
            ],


            // ***

            'number_of_contacts' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Կոնտակտների քանակ',
                    'en' => 'Number of contacts',
                    'ru' => 'Количество контактов',
                ],
                'values' => [
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                    ['code'=>'4','translations'=>['hy'=>'4','en'=>'4','ru'=>'4']]

                ],
            ],

            'contact_type' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Կոնտակտների տեսակը',
                    'en' => 'Contact type',
                    'ru' => 'Тип контактов',
                ],
                'values' => [
                    ['code'=>'3P_E','translations'=>['hy'=>'3P+E','en'=>'3P+E','ru'=>'3P+E']],
                    ['code'=>'2P_E','translations'=>['hy'=>'2P+E','en'=>'2P+E','ru'=>'2P+E']],
                    ['code'=>'NO','translations'=>['hy'=>'NO','en'=>'NO','ru'=>'NO']],
                    ['code'=>'NC','translations'=>['hy'=>'NC','en'=>'NC','ru'=>'NC']],
                    ['code' => '2NO', 'translations' => ['hy' => '2NO', 'en' => '2NO', 'ru' => '2NO']],
                    ['code' => '2NC', 'translations' => ['hy' => '2NC', 'en' => '2NC', 'ru' => '2NC']],
                ],
            ],


            // ***
            'degree_of_protection' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Պաշտպանություն աստիճանը',
                    'en' => 'Degree of protection',
                    'ru' => 'Степень защиты',
                ],
                'values' => [
                    ['code'=>'IP44','translations'=>['hy'=>'IP44','en'=>'IP44','ru'=>'IP44']],
                    ['code'=>'IP67','translations'=>['hy'=>'IP67','en'=>'IP67','ru'=>'IP67']],
                ],
            ],


            // ***
            'number_of_positions' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Դիրքերի քանակ',
                    'en' => 'Number of positions',
                    'ru' => 'Количество положений',
                ],
                'values' => [
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                ],
            ],

            // ***
            'led_display' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Լեդ էկրանով',
                    'en' => 'With LED display',
                    'ru' => 'С LED-дисплеем',
                ],
                'values' => [
                    ['code'=>'yes','translations'=>['hy'=>'այո','en'=>'Yes','ru'=>'Да']],
                    ['code'=>'no','translations'=>['hy'=>'ոչ','en'=>'No','ru'=>'Нет']],
                ],
            ],

            'class' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Դաս',
                    'en' => 'Class',
                    'ru' => 'Класс',
                ],
                'values' => [
                    ['code'=>'A','translations'=>['hy'=>'A','en'=>'A','ru'=>'A']],
                    ['code'=>'MCB_A','translations'=>['hy'=>'MCB AA','en'=>'MCB A','ru'=>'MCB A']],
                    ['code'=>'B','translations'=>['hy'=>'B','en'=>'B','ru'=>'B']],
                    ['code'=>'MCB_B','translations'=>['hy'=>'MCB B','en'=>'MCB B','ru'=>'MCB B']],
                    ['code'=>'C','translations'=>['hy'=>'C','en'=>'C','ru'=>'C']],
                    ['code'=>'MCB_C','translations'=>['hy'=>'MCB C','en'=>'MCB C','ru'=>'MCB C']],


                ],
            ],



            'mobile' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Շարժական',
                    'en' => 'Mobile',
                    'ru' => 'Мобильный',
                ],
                'values' => [
                    ['code'=>'yes','translations'=>['hy'=>'այո','en'=>'Yes','ru'=>'Да']],
                    ['code'=>'no','translations'=>['hy'=>'ոչ','en'=>'No','ru'=>'Нет']],
                ],
            ],



            'split_controller' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Առանձնացված վահանակով',
                    'en' => 'Split controller',
                    'ru' => 'С разделенным контроллером',
                ],
                'values' => [
                    ['code'=>'yes','translations'=>['hy'=>'այո','en'=>'Yes','ru'=>'Да']],
                    ['code'=>'no','translations'=>['hy'=>'ոչ','en'=>'No','ru'=>'Нет']],
                ],
            ],

            'size' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Չափ',
                    'en' => 'Size',
                    'ru' => 'Размер',
                ],
                'values' => [
                    ['code'=>'2','translations'=>['hy'=>'2 մմ','en'=>'2 mm','ru'=>'2 мм']],
                    ['code'=>'11','translations'=>['hy'=>'11 մմ','en'=>'11 mm','ru'=>'11 мм']],
                    ['code'=>'22','translations'=>['hy'=>'22 մմ','en'=>'22 mm','ru'=>'22 мм']],
                    ['code'=>'40','translations'=>['hy'=>'40 մմ','en'=>'40 mm','ru'=>'40 мм']],
                ],
            ],


            'position' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Դիրքը',
                    'en' => 'Position',
                    'ru' => 'Положение',
                ],
                'values' => [
                    ['code'=>'top','translations'=>['hy'=>'Ճակատային','en'=>'Top','ru'=>'Фронтальное']],
                    ['code'=>'side','translations'=>['hy'=>'Կողային','en'=>'Side','ru'=>'Боковое']],
                ],
            ],

            'pin_number' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ոտիկների քանակ',
                    'en' => 'Pin number',
                    'ru' => 'Количестов гнезд'
                ],
                'values' => [
                    ['code' => '8', 'translations' => ['hy' => '8', 'en' => '8', 'ru' => '8']],
                    ['code' => '11', 'translations' => ['hy' => '11', 'en' => '11', 'ru' => '11']],
                    ['code' => '14', 'translations' => ['hy' => '14', 'en' => '14', 'ru' => '14']]

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
