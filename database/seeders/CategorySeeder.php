<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Очищаем таблицы перед заполнением
        DB::table('category_translations')->truncate();
        DB::table('categories')->truncate();

        Schema::enableForeignKeyConstraints();

        // Вставляем категории с новыми ID по порядку
        $categories = [
            // id 1 - Распределительные коробки
            [
                'id' => 1,
                'parent_id' => null,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2025-12-20 21:08:10',
                'updated_at' => '2026-03-21 19:16:21',
            ],
            // id 2 - Пластмассовые (дочерняя категория для id 1)
            [
                'id' => 2,
                'parent_id' => 1,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2025-12-28 22:33:30',
                'updated_at' => '2026-03-21 19:44:12',
            ],
            // id 3 - Пускатели и аксессуары
            [
                'id' => 3,
                'parent_id' => null,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 20:48:30',
                'updated_at' => '2026-03-21 19:45:50',
            ],
            // id 4 - Пускатели (дочерняя категория для id 3)
            [
                'id' => 4,
                'parent_id' => 3,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 20:49:55',
                'updated_at' => '2026-03-21 19:47:17',
            ],
            // id 5 - Реверсный контакт (дочерняя категория для id 3)
            [
                'id' => 5,
                'parent_id' => 3,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 20:50:52',
                'updated_at' => '2026-03-21 19:49:13',
            ],
            // id 6 - Вспомогательные контакты (дочерняя категория для id 3)
            [
                'id' => 6,
                'parent_id' => 3,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 20:51:55',
                'updated_at' => '2026-03-21 19:50:49',
            ],
            // id 7 - Реле и комплектующие
            [
                'id' => 7,
                'parent_id' => null,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:27:52',
                'updated_at' => '2026-03-21 19:54:52',
            ],
            // id 8 - Реле времени (дочерняя категория для id 7)
            [
                'id' => 8,
                'parent_id' => 7,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:28:48',
                'updated_at' => '2026-03-21 19:56:06',
            ],
            // id 9 - Автоматические выключатели
            [
                'id' => 9,
                'parent_id' => null,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:30:19',
                'updated_at' => '2026-03-21 19:57:19',
            ],
            // id 10 - Автоматический выключатель двигателя (дочерняя категория для id 9)
            [
                'id' => 10,
                'parent_id' => 9,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:31:17',
                'updated_at' => '2026-03-21 20:31:43',
            ],
            // id 11 - Поворотная ручка мотора (дочерняя категория для id 9)
            [
                'id' => 11,
                'parent_id' => 9,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:32:12',
                'updated_at' => '2026-03-21 20:34:40',
            ],
            // id 12 - Силовые трехфазные автоматы (дочерняя категория для id 9)
            [
                'id' => 12,
                'parent_id' => 9,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:33:06',
                'updated_at' => '2026-03-21 20:37:42',
            ],
            // id 13 - Компоненты управления
            [
                'id' => 13,
                'parent_id' => null,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:41:17',
                'updated_at' => '2026-03-21 20:43:53',
            ],
            // id 14 - Корпус пульта (дочерняя категория для id 13)
            [
                'id' => 14,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-01-03 22:42:35',
                'updated_at' => '2026-03-21 20:46:12',
            ],
            // id 15 - Термореле перегрузки (дочерняя категория для id 7)
            [
                'id' => 15,
                'parent_id' => 7,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:17:40',
                'updated_at' => '2026-03-21 20:17:40',
            ],
            // id 16 - Инверторы, Стабилизаторы и переключатели
            [
                'id' => 16,
                'parent_id' => null,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:21:48',
                'updated_at' => '2026-03-21 20:21:48',
            ],
            // id 17 - Инверторы (дочерняя категория для id 16)
            [
                'id' => 17,
                'parent_id' => 16,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:23:12',
                'updated_at' => '2026-03-21 20:23:12',
            ],
            // id 18 - Автоматический выключатель дифференциального тока (дочерняя категория для id 9)
            [
                'id' => 18,
                'parent_id' => 9,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:40:31',
                'updated_at' => '2026-03-21 20:40:31',
            ],
            // id 19 - Реле (дочерняя категория для id 7)
            [
                'id' => 19,
                'parent_id' => 7,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:52:08',
                'updated_at' => '2026-03-21 20:52:08',
            ],
            // id 20 - Промышленные вилки и розетки (дочерняя категория для id 13)
            [
                'id' => 20,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:56:45',
                'updated_at' => '2026-03-21 20:56:45',
            ],
            // id 21 - Блоки питания (дочерняя категория для id 13)
            [
                'id' => 21,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 20:58:40',
                'updated_at' => '2026-03-21 20:58:40',
            ],
            // id 22 - Лампочки (дочерняя категория для id 13)
            [
                'id' => 22,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:01:50',
                'updated_at' => '2026-03-21 21:03:05',
            ],
            // id 23 - Кнопки (дочерняя категория для id 13)
            [
                'id' => 23,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:04:17',
                'updated_at' => '2026-03-21 21:04:17',
            ],
            // id 24 - Переключатели (дочерняя категория для id 13)
            [
                'id' => 24,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:05:57',
                'updated_at' => '2026-03-21 21:05:57',
            ],
            // id 25 - Контактные узлы (дочерняя категория для id 13)
            [
                'id' => 25,
                'parent_id' => 13,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:07:24',
                'updated_at' => '2026-03-21 21:07:24',
            ],
            // id 26 - Стабилизаторы напряжения (дочерняя категория для id 16)
            [
                'id' => 26,
                'parent_id' => 16,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:09:41',
                'updated_at' => '2026-03-21 21:09:41',
            ],
            // id 27 - Разъемы реле (дочерняя категория для id 7)
            [
                'id' => 27,
                'parent_id' => 7,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:11:32',
                'updated_at' => '2026-03-21 21:11:32',
            ],
            // id 28 - Модульный автоматический пускатель (дочерняя категория для id 3)
            [
                'id' => 28,
                'parent_id' => 3,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:16:47',
                'updated_at' => '2026-03-21 21:16:47',
            ],
            // id 29 - Автоматические переключатели тока (дочерняя категория для id 16)
            [
                'id' => 29,
                'parent_id' => 16,
                'active' => 1,
                'deleted_at' => null,
                'created_at' => '2026-03-21 21:19:22',
                'updated_at' => '2026-03-21 21:19:22',
            ],
        ];

        // Вставляем все категории
        // foreach ($categories as $category) {
        //     DB::table('categories')->insert($category);
        // }
        DB::table('categories')->insert($categories);

        $this->command->info('Categories seeded successfully! Total: ' . count($categories));
    }
}
