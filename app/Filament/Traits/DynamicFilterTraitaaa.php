<?php

namespace App\Filament\Traits;

use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait DynamicFilterTraitaaa
{
    /**
     * Создать динамический фильтр по описанию
     *
     * @param array $fields Массив описаний полей фильтра.
     *      Каждый элемент:
     *          'name' => string, ключ для поля и фильтра
     *          'type' => string, 'text'|'number'|'toggle'|'select' и т.п.
     *          'label' => string, подпись
     *          'translation' => [ // опционально для текстовых полей, поиск по translation
     *              'locale' => string,
     *              'field' => string, например 'name'
     *              'relations' => [relationName => fieldName, ...] // для поиска в связях
     *          ]
     *          'db_column' => string, колонка в таблице (для числовых, булевых и т.п.)
     *          'range' => bool, для числовых - включить диапазон (min, max)
     *          'options' => array|string|null, для select
     *          // и другие параметры по необходимости
     * @param string $filterName имя фильтра (по умолчанию 'dynamic_filter')
     * @return Filter
     */
    public static  function makeDynamicFilter(array $fields, string $filterName = 'dynamic_filter'): Filter
    {
        // Формируем поля формы фильтра
        $formComponents = [];

        foreach ($fields as $field) {
            $name = $field['name'];
            $label = $field['label'] ?? ucfirst($name);
            $type = $field['type'] ?? 'text';

            if ($type === 'text' && isset($field['translation'])) {
                // Текстовое поле для поиска по переводам
                $formComponents[] = Forms\Components\TextInput::make($name)
                    ->label($label)
                    ->placeholder('Поиск...');
            } elseif ($type === 'number') {
                if (!empty($field['range'])) {
                    // Если диапазон — создаем 2 поля: min и max
                    $formComponents[] = Forms\Components\TextInput::make($name . '_min')
                        ->label($label . ' (мин)')
                        ->numeric();

                    $formComponents[] = Forms\Components\TextInput::make($name . '_max')
                        ->label($label . ' (макс)')
                        ->numeric();
                } else {
                    $formComponents[] = Forms\Components\TextInput::make($name)
                        ->label($label)
                        ->numeric();
                }
            } elseif ($type === 'toggle') {
                $formComponents[] = Forms\Components\Toggle::make($name)
                    ->label($label);
            } elseif ($type === 'select') {
                $formComponents[] = Forms\Components\Select::make($name)
                    ->label($label)
                    ->options($field['options'] ?? []);
            } else {
                // По умолчанию текстовое поле
                $formComponents[] = Forms\Components\TextInput::make($name)
                    ->label($label);
            }
        }

        return Filter::make($filterName)
            ->form($formComponents)
            ->query(function (Builder $query, array $data) use ($fields) {
                foreach ($fields as $field) {
                    $name = $field['name'];
                    $type = $field['type'] ?? 'text';
                    $dbColumn = $field['db_column'] ?? $name;
                    $translation = $field['translation'] ?? null;

                    if ($type === 'text' && $translation) {
                        if (!empty($data[$name])) {
                            $search = $data[$name];
                            $locale = $translation['locale'] ?? 'am';
                            $transField = $translation['field'] ?? 'name';
                            $relations = $translation['relations'] ?? [];

                            $query->where(function ($q) use ($search, $locale, $transField, $relations) {
                                $q->whereHas('translations', function ($q2) use ($search, $locale, $transField) {
                                    $q2->where('locale', $locale)
                                        ->where($transField, 'like', "%{$search}%");
                                });

                                foreach ($relations as $rel => $fieldRel) {
                                    $q->orWhereHas("{$rel}.translations", function ($q3) use ($search, $locale, $fieldRel) {
                                        $q3->where('locale', $locale)
                                            ->where($fieldRel, 'like', "%{$search}%");
                                    });
                                }
                            });
                        }
                    } elseif ($type === 'number') {
                        // Диапазон
                        if (!empty($field['range'])) {
                            $minKey = $name . '_min';
                            $maxKey = $name . '_max';
                            if (!empty($data[$minKey])) {
                                $query->where($dbColumn, '>=', $data[$minKey]);
                            }
                            if (!empty($data[$maxKey])) {
                                $query->where($dbColumn, '<=', $data[$maxKey]);
                            }
                        } else {
                            if (!empty($data[$name])) {
                                $query->where($dbColumn, $data[$name]);
                            }
                        }
                    } elseif ($type === 'toggle') {
                        if (isset($data[$name])) {
                            $query->where($dbColumn, $data[$name]);
                        }
                    } elseif ($type === 'select') {
                        if (!empty($data[$name])) {
                            $query->where($dbColumn, $data[$name]);
                        }
                    } else {
                        // Простой текстовый поиск по столбцу (не перевод)
                        if (!empty($data[$name])) {
                            $query->where($dbColumn, 'like', '%'.$data[$name].'%');
                        }
                    }
                }
            });
    }
}
