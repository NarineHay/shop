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
                'translations' => ['hy' => 'Հզորություն (կՎԱ)','en' => 'Power (kVA)','ru' => 'Мощность (кВА)'],
                'values' => [
                    ['code'=>'1','translations'=>['hy'=>'1 կՎԱ','en'=>'1 kVA','ru'=>'1 кВА']],
                    ['code'=>'1','translations'=>['hy'=>'1.5 կՎԱ','en'=>'1.5 kVA','ru'=>'1.5 кВА']],
                    ['code'=>'3','translations'=>['hy'=>'3 կՎԱ','en'=>'3 kVA','ru'=>'3 кВА']],
                    ['code'=>'5','translations'=>['hy'=>'5 կՎԱ','en'=>'5 kVA','ru'=>'5 кВА']],
                    ['code'=>'6','translations'=>['hy'=>'6 կՎԱ','en'=>'6 kVA','ru'=>'6 кВА']],
                    ['code'=>'7','translations'=>['hy'=>'7 կՎԱ','en'=>'7 kVA','ru'=>'7 кВА']],
                    ['code'=>'9','translations'=>['hy'=>'9 կՎԱ','en'=>'9 kVA','ru'=>'9 кВА']],
                    ['code'=>'10','translations'=>['hy'=>'10 կՎԱ','en'=>'10 kVA','ru'=>'10 кВА']],
                    ['code'=>'15','translations'=>['hy'=>'15 կՎԱ','en'=>'15 kVA','ru'=>'15 кВА']],
                    ['code'=>'20','translations'=>['hy'=>'20 կՎԱ','en'=>'20 kVA','ru'=>'20 кВА']],
                    ['code'=>'30','translations'=>['hy'=>'30 կՎԱ','en'=>'30 kVA','ru'=>'30 кВА']],
                    ['code'=>'45','translations'=>['hy'=>'45 կՎԱ','en'=>'45 kVA','ru'=>'45 кВА']],
                    ['code'=>'60','translations'=>['hy'=>'60 կՎԱ','en'=>'60 kVA','ru'=>'60 кВА']],

                    // добавь остальные значения
                ],
            ],


             // ***
             'power_kw' => [
                'type' => 'select',
                'translations' => ['hy' => 'Հզորություն (կՎտ)','en' => 'Power (kW)','ru' => 'Мощность (кВт)'],
                'values' => [
                    ['code'=>'0.75','translations'=>['hy'=>'0.75 կՎտ','en'=>'0.75 kW','ru'=>'0.75 кВт']],
                    ['code'=>'1.5','translations'=>['hy'=>'1.5 կՎտ','en'=>'1.5 kW','ru'=>'1.5 кВт']],
                    ['code'=>'2.2','translations'=>['hy'=>'2.2 կՎտ','en'=>'2.2 kW','ru'=>'2.2 кВт']],
                    ['code'=>'4','translations'=>['hy'=>'4 կՎտ','en'=>'4 kW','ru'=>'4 кВт']],
                    ['code'=>'5.5','translations'=>['hy'=>'5.5 կՎտ','en'=>'5.5 kW','ru'=>'5.5 кВт']],
                    ['code'=>'7.5','translations'=>['hy'=>'7.5 կՎտ','en'=>'7.5 kW','ru'=>'7.5 кВт']],
                    ['code'=>'11','translations'=>['hy'=>'11 կՎտ','en'=>'11 kW','ru'=>'11 кВт']],
                    ['code'=>'15','translations'=>['hy'=>'15 կՎտ','en'=>'15 kW','ru'=>'15 кВт']],
                    ['code'=>'18.5','translations'=>['hy'=>'18.5 կՎտ','en'=>'18.5 kW','ru'=>'18.5 кВт']],
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


                    // добавь остальные значения
                ],
            ],


            // ***
            'seats_count' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Տեղերի քանակ',
                    'en' => 'Number of seats',
                    'ru' => 'Количество мест'
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
                        'code' => 'external',
                        'translations' => [
                            'hy' => 'Արտաքին',
                            'en' => 'External',
                            'ru' => 'Наружный',
                        ],
                    ],
                    [
                        'code' => 'internal',
                        'translations' => [
                            'hy' => 'Ներքին',
                            'en' => 'Internal',
                            'ru' => 'Внутренний',
                        ],
                    ],
                ],
            ],


            // ***
            'security_type' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Անվտանգությունը',
                    'en' => 'Security type',
                    'ru' => 'Тип безопасности',
                ],
                'values' => [
                    [
                        'code' => 'standard',
                        'translations' => [
                            'hy' => 'Սովորական',
                            'en' => 'Standard',
                            'ru' => 'Обычная',
                        ],
                    ],
                    [
                        'code' => 'fireproof',
                        'translations' => [
                            'hy' => 'Հրակայուն',
                            'en' => 'Fireproof',
                            'ru' => 'Огнестойкая',
                        ],
                    ],
                ],
            ],

            // ***
            'construction_type' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Կառուցվածք',
                    'en' => 'Construction type',
                    'ru' => 'Тип конструкции',
                ],
                'values' => [
                    [
                        'code' => 'metal',
                        'translations' => [
                            'hy' => 'Մետաղական',
                            'en' => 'Metal',
                            'ru' => 'Металлическая',
                        ],
                    ],
                    [
                        'code' => 'non_metal',
                        'translations' => [
                            'hy' => 'Ոչ մետաղական',
                            'en' => 'Non-metal',
                            'ru' => 'Неметаллическая',
                        ],
                    ],
                ],
            ],


            // ***
            'current_amperage' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Հոսանքի ուժ',
                    'en' => 'Current (A)',
                    'ru' => 'Сила тока (А)',
                ],
                'values' => [
                    ['code' => '0_01_0_16', 'translations' => ['hy' => '0.1–0.16 A', 'en' => '0.1–0.16 A', 'ru' => '0.1–0.16 А']],
                    ['code' => '0_16_0_25', 'translations' => ['hy' => '0.16–0.25 A', 'en' => '0.16–0.25 A', 'ru' => '0.16–0.25 А']],
                    ['code' => '0_25_0_4', 'translations' => ['hy' => '0.25–0.4 A', 'en' => '0.25–0.4 A', 'ru' => '0.25–0.4 А']],
                    ['code' => '0_4_0_6', 'translations' => ['hy' => '0.4–0.6 A', 'en' => '0.4–0.6 A', 'ru' => '0.4–0.6 А']],
                    ['code' => '0_4_0_63', 'translations' => ['hy' => '0.4–0.63 A', 'en' => '0.4–0.63 A', 'ru' => '0.4–0.63 А']],
                    ['code' => '0_63_1', 'translations' => ['hy' => '0.63–1 A', 'en' => '0.63–1 A', 'ru' => '0.63–1 А']],
                    ['code' => '1_1_6', 'translations' => ['hy' => '1–1.6 A', 'en' => '1–1.6 A', 'ru' => '1–1.6 А']],
                    ['code' => '1_6_2_5', 'translations' => ['hy' => '1.6–2.5 A', 'en' => '1.6–2.5 A', 'ru' => '1.6–2.5 А']],
                    ['code' => '2_5_4', 'translations' => ['hy' => '2.5–4 A', 'en' => '2.5–4 A', 'ru' => '2.5–4 А']],
                    ['code' => '4_6_3', 'translations' => ['hy' => '4–6.3 A', 'en' => '4–6.3 A', 'ru' => '4–6.3 А']],
                    ['code' => '5_5_8', 'translations' => ['hy' => '5.5–8 A', 'en' => '5.5–8 A', 'ru' => '5.5–8 А']],
                    ['code' => '6_10', 'translations' => ['hy' => '6–10 A', 'en' => '6–10 A', 'ru' => '6–10 А']],
                    ['code' => '7_10', 'translations' => ['hy' => '7–10 A', 'en' => '7–10 A', 'ru' => '7–10 А']],
                    ['code' => '9_13', 'translations' => ['hy' => '9–13 A', 'en' => '9–13 A', 'ru' => '9–13 А']],
                    ['code' => '9_14', 'translations' => ['hy' => '9–14 A', 'en' => '9–14 A', 'ru' => '9–14 А']],
                    ['code' => '9_38', 'translations' => ['hy' => '9–38 A', 'en' => '9–38 A', 'ru' => '9–38 А']],
                    ['code' => '12_18', 'translations' => ['hy' => '12–18 A', 'en' => '12–18 A', 'ru' => '12–18 А']],
                    ['code' => '13_18', 'translations' => ['hy' => '13–18 A', 'en' => '13–18 A', 'ru' => '13–18 А']],
                    ['code' => '17_23', 'translations' => ['hy' => '17–23 A', 'en' => '17–23 A', 'ru' => '17–23 А']],
                    ['code' => '17_25', 'translations' => ['hy' => '17–25 A', 'en' => '17–25 A', 'ru' => '17–25 А']],
                    ['code' => '20_25', 'translations' => ['hy' => '20–25 A', 'en' => '20–25 A', 'ru' => '20–25 А']],
                    ['code' => '24_32', 'translations' => ['hy' => '24–32 A', 'en' => '24–32 A', 'ru' => '24–32 А']],
                    ['code' => '25_40', 'translations' => ['hy' => '25–40 A', 'en' => '25–40 A', 'ru' => '25–40 А']],
                    ['code' => '40_60', 'translations' => ['hy' => '40–60 A', 'en' => '40–60 A', 'ru' => '40–60 А']],
                    ['code' => '40_95', 'translations' => ['hy' => '40–95 A','en' => '40–95 A','ru' => '40–95 А']],
                    ['code' => '56_80', 'translations' => ['hy' => '56–80 A', 'en' => '56–80 A', 'ru' => '56–80 А']],
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
            'time_interval' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ժամանակահատված',
                    'en' => 'Time interval',
                    'ru' => 'Временной диапазон',
                ],
                'values' => [
                    ['code'=>'0_1','translations'=>['hy'=>'0.1 վրկ','en'=>'0.1 sec','ru'=>'0.1 сек']],
                    ['code'=>'1_3','translations'=>['hy'=>'1–3 վրկ','en'=>'1–3 sec','ru'=>'1–3 сек']],
                    ['code'=>'10_180','translations'=>['hy'=>'10–180 վրկ','en'=>'10–180 sec','ru'=>'10–180 сек']],
                    ['code'=>'0_1_30','translations'=>['hy'=>'0.1–30 վրկ','en'=>'0.1–30 sec','ru'=>'0.1–30 сек']],
                ],
            ],


            // ***
            'phase_count' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Ֆազերի քանակ',
                    'en' => 'Number of phases',
                    'ru' => 'Количество фаз',
                ],
                'values' => [
                    ['code'=>'1_3','translations'=>['hy'=>'1 ֆազ – 3 ֆազ','en'=>'1 phase – 3 phases','ru'=>'1 фаза – 3 фазы']],
                    ['code'=>'3_3','translations'=>['hy'=>'3 ֆազ – 3 ֆազ','en'=>'3 phases – 3 phases','ru'=>'3 фазы – 3 фазы']],
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
                    ['code'=>'380','translations'=>['hy'=>'380 V','en'=>'380 V','ru'=>'380 В']],
                ],
            ],


            // ***

            'passage_count' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Անցքերի քանակ',
                    'en' => 'Number of passages',
                    'ru' => 'Количество проходов',
                ],
                'values' => [
                    ['code'=>'1','translations'=>['hy'=>'1','en'=>'1','ru'=>'1']],
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                    ['code'=>'4','translations'=>['hy'=>'4','en'=>'4','ru'=>'4']],
                ],
            ],

            // ***

            'passage_diameter' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Անցքի տրամագիծ',
                    'en' => 'Passage diameter',
                    'ru' => 'Диаметр прохода',
                ],
                'values' => [
                    ['code'=>'22','translations'=>['hy'=>'22 մմ','en'=>'22 mm','ru'=>'22 мм']],
                    ['code'=>'30','translations'=>['hy'=>'30 մմ','en'=>'30 mm','ru'=>'30 мм']],
                ],
            ],


            // ***

            'contact_count' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Կոնտակտների քանակ',
                    'en' => 'Number of contacts',
                    'ru' => 'Количество контактов',
                ],
                'values' => [
                    ['code'=>'2','translations'=>['hy'=>'2','en'=>'2','ru'=>'2']],
                    ['code'=>'3','translations'=>['hy'=>'3','en'=>'3','ru'=>'3']],
                    ['code'=>'4','translations'=>['hy'=>'4','en'=>'4','ru'=>'4']],
                    ['code'=>'3P_E','translations'=>['hy'=>'3P+E','en'=>'3P+E','ru'=>'3P+E']],
                    ['code'=>'2P_E','translations'=>['hy'=>'2P+E','en'=>'2P+E','ru'=>'2P+E']],
                ],
            ],


            // ***
            'protection' => [
                'type' => 'select',
                'translations' => [
                    'hy' => 'Պաշտպանություն',
                    'en' => 'Protection',
                    'ru' => 'Защита',
                ],
                'values' => [
                    ['code'=>'IP44','translations'=>['hy'=>'IP44','en'=>'IP44','ru'=>'IP44']],
                    ['code'=>'IP67','translations'=>['hy'=>'IP67','en'=>'IP67','ru'=>'IP67']],
                ],
            ],


            // ***
            'position_count' => [
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



            // 'supply_frequency' => [
            //     'type' => 'select',
            //     'translations' => ['hy'=>'Հաճախականություն','en'=>'Frequency','ru'=>'Частота'],
            //     'values' => [
            //         ['code'=>'50Hz','translations'=>['hy'=>'50Hz','en'=>'50Hz','ru'=>'50Hz']],
            //         ['code'=>'60Hz','translations'=>['hy'=>'60Hz','en'=>'60Hz','ru'=>'60Hz']],
            //     ],
            // ],



            // 'ip_rating' => [
            //     'type' => 'select',
            //     'translations' => ['hy'=>'Պաշտպանության աստիճան','en'=>'IP Rating','ru'=>'Степень защиты'],
            //     'values' => [
            //         ['code'=>'ip20','translations'=>['hy'=>'IP20','en'=>'IP20','ru'=>'IP20']],
            //         ['code'=>'ip44','translations'=>['hy'=>'IP44','en'=>'IP44','ru'=>'IP44']],
            //         ['code'=>'ip67','translations'=>['hy'=>'IP67','en'=>'IP67','ru'=>'IP67']],
            //     ],
            // ],

            // 'width_mm' => [
            //     'type' => 'select',
            //     'translations' => ['hy'=>'Լայնություն (մմ)','en'=>'Width (mm)','ru'=>'Ширина (мм)'],
            //     'values' => [
            //         ['code'=>'22','translations'=>['hy'=>'22','en'=>'22','ru'=>'22']],
            //         ['code'=>'27','translations'=>['hy'=>'27','en'=>'27','ru'=>'27']],
            //         ['code'=>'30','translations'=>['hy'=>'30','en'=>'30','ru'=>'30']],
            //         ['code'=>'40','translations'=>['hy'=>'40','en'=>'40','ru'=>'40']],
            //     ],
            // ],

            // 'height_mm' => [
            //     'type' => 'select',
            //     'translations' => ['hy'=>'Բարձրություն (մմ)','en'=>'Height (mm)','ru'=>'Высота (мм)'],
            //     'values' => [
            //         ['code'=>'100','translations'=>['hy'=>'100','en'=>'100','ru'=>'100']],
            //         ['code'=>'150','translations'=>['hy'=>'150','en'=>'150','ru'=>'150']],
            //         ['code'=>'200','translations'=>['hy'=>'200','en'=>'200','ru'=>'200']],
            //     ],
            // ],

            // 'depth_mm' => [
            //     'type' => 'select',
            //     'translations' => ['hy'=>'Խորություն (մմ)','en'=>'Depth (mm)','ru'=>'Глубина (мм)'],
            //     'values' => [
            //         ['code'=>'50','translations'=>['hy'=>'50','en'=>'50','ru'=>'50']],
            //         ['code'=>'60','translations'=>['hy'=>'60','en'=>'60','ru'=>'60']],
            //         ['code'=>'70','translations'=>['hy'=>'70','en'=>'70','ru'=>'70']],
            //     ],
            // ],

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
