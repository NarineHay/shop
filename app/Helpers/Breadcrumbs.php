<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Route;
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

                $href = null;
                if (Route::has($cumulative)) {
                    $route = Route::getRoutes()->getByName($cumulative);
                    $parameterNames = $route?->parameterNames() ?? [];

                    // Если у маршрута нет обязательных параметров — можно строить ссылку
                    if (empty($parameterNames) || $parameterNames === ['locale']) {
                        $href = route($cumulative, ['locale' => app()->getLocale()]);
                    }
                }

                $breadcrumbs[] = [
                    'label' => 'breadcrumbs.' . $segment,
                    'href' => $href,
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
