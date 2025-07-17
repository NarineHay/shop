<?php

namespace App\Filament\Traits;

use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;

trait DynamicFilterTrait
{
    public static function makeDynamicFilter(string $key, array $config)
    {
        $type = $config['type'] ?? 'text';
        $label = $config['label'] ?? ucfirst($key);
        $relation = $config['relation'] ?? null;
        $column = $config['column'] ?? $key;
        $operator = $config['operator'] ?? 'like';

        $queryCallback = function ($builder, $data) use ($relation, $column, $operator) {
            if (empty($data['value'])) {
                return;
            }

            $value = $data['value'];

            if ($relation) {
                $builder->whereHas($relation, function ($q) use ($column, $operator, $value) {
                    $q->where($column, $operator, $operator === 'like' ? "%{$value}%" : $value);
                });
            } else {
                $builder->where($column, $operator, $operator === 'like' ? "%{$value}%" : $value);
            }
        };

        return match ($type) {
            'select' => Filter::make($key)
                ->form([
                    Select::make('value')
                        ->label($label)
                        ->options($config['options'] ?? []),
                ])
                ->query($queryCallback)
                ->label($label),

            'ternary' => TernaryFilter::make($key)
                ->label($label)
                ->trueLabel($config['trueLabel'] ?? 'Yes')
                ->falseLabel($config['falseLabel'] ?? 'No')
                ->queries(
                    true: function ($builder) use ($column) { return $builder->where($column, true); },
                    false: function ($builder) use ($column) { return $builder->where($column, false); },
                    blank: function ($builder) { return $builder; },
                ),

            default => Filter::make($key)
                ->form([
                    TextInput::make('value')->label($label),
                ])
                ->query($queryCallback)
                ->label($label),
        };
    }

    public static function makeRangeFilter(string $key, array $config)
    {
        $label = $config['label'] ?? ucfirst($key);
        $column = $config['column'] ?? $key;

        return Filter::make($key)
            ->label($label)
            ->form([
                Grid::make(2)->schema([
                    TextInput::make('from')->label('От')->numeric(),
                    TextInput::make('to')->label('До')->numeric(),
                ]),
            ])
            ->query(function ($builder, $data) use ($column) {
                if (!empty($data['from'])) {
                    $builder->where($column, '>=', $data['from']);
                }
                if (!empty($data['to'])) {
                    $builder->where($column, '<=', $data['to']);
                }
            });
    }

    public static function makeDynamicFilters(array $filters): array
    {
        $result = [];

        foreach ($filters as $key => $config) {
            $filter = match ($config['type'] ?? 'text') {
                'range' => static::makeRangeFilter($key, $config),
                default => static::makeDynamicFilter($key, $config),
            };

            $result[] = $filter;
        }

        return $result;
    }
}
