<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['code' => 'YR', 'translations' => [
                'hy' => 'Երևան', 'en' => 'Yerevan', 'ru' => 'Ереван',
            ]],
            ['code' => 'AG', 'translations' => [
                'hy' => 'Արագածոտն', 'en' => 'Aragatsotn', 'ru' => 'Арагацотн',
            ]],
            ['code' => 'AR', 'translations' => [
                'hy' => 'Արարատ', 'en' => 'Ararat', 'ru' => 'Арарат',
            ]],
            ['code' => 'AM', 'translations' => [
                'hy' => 'Արմավիր', 'en' => 'Armavir', 'ru' => 'Армавир',
            ]],
            ['code' => 'GE', 'translations' => [
                'hy' => 'Գեղարքունիք', 'en' => 'Gegharkunik', 'ru' => 'Гегարкуник',
            ]],
            ['code' => 'KO', 'translations' => [
                'hy' => 'Կոտայք', 'en' => 'Kotayk', 'ru' => 'Котайк',
            ]],
            ['code' => 'LO', 'translations' => [
                'hy' => 'Լոռի', 'en' => 'Lori', 'ru' => 'Лори',
            ]],
            ['code' => 'SH', 'translations' => [
                'hy' => 'Շիրակ', 'en' => 'Shirak', 'ru' => 'Ширак',
            ]],
            ['code' => 'SY', 'translations' => [
                'hy' => 'Սյունիք', 'en' => 'Syunik', 'ru' => 'Сюник',
            ]],
            ['code' => 'TA', 'translations' => [
                'hy' => 'Տավուշ', 'en' => 'Tavush', 'ru' => 'Тавуш',
            ]],
            ['code' => 'VD', 'translations' => [
                'hy' => 'Վայոց Ձոր', 'en' => 'Vayots Dzor', 'ru' => 'Вайоц Ձոր',
            ]],
        ];

        foreach ($regions as $regionData) {
            
            $region = Region::create([
                'code' => $regionData['code'],
            ]);

            
            foreach ($regionData['translations'] as $locale => $name) {
                $region->translations()->create([
                    'locale' => $locale,
                    'name' => $name,
                ]);
            }
        }
    }
}
