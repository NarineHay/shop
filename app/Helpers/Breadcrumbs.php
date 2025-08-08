<?php

namespace App\Helpers;

use Route;
use Str;


class Breadcrumbs
{
    protected static array $custom = [];

    /**
     * Задать крошки вручную (опционально)
     */
    public static function set(array $items): void
    {
        static::$custom = collect($items)->map(function ($item) {
            if (is_string($item)) {
                return ['label' => $item];
            }
            return $item;
        })->toArray();
    }

    /**
     * Получить крошки — либо вручную заданные, либо авто
     */
    public static function get(): array
    {
        return static::$custom ?: static::generateFromRoute();
    }

    /**
     * Автоматическая генерация из route name
     */
    protected static function generateFromRoute(): array
    {
        $routeName = Route::currentRouteName();
        $breadcrumbs = [];

        if ($routeName) {
            $segments = explode('.', $routeName);

            // Добавляем "Home"
            $breadcrumbs[] = [
                'label' => 'breadcrumbs.welcome',
                'href' => route('welcome', ['locale' => app()->getLocale()]),
            ];

            $cumulative = '';
            foreach ($segments as $index => $segment) {
                $cumulative .= ($index > 0 ? '.' : '') . $segment;

                $breadcrumbs[] = [
                    'label' => $segment,

                    // 'label' => Str::title(str_replace(['-', '_'], ' ', $segment)),
                    // 'label' => __('breadcrumbs.' . $segment) !== 'breadcrumbs.' . $segment
                    //     ? __('breadcrumbs.' . $segment)
                    //     : Str::title(str_replace(['-', '_'], ' ', $segment)),
                    'href' => Route::has($cumulative) ? route($cumulative, ['locale' => app()->getLocale()]) : null,
                ];
            }
        }

        return $breadcrumbs;
    }

    /**
     * Очистить вручную заданные крошки
     */
    public static function clear(): void
    {
        static::$custom = [];
    }
}
