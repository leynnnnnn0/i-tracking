<?php

namespace App\Traits;

trait HasSelectOptions
{
    public function scopeToSelectOptions($query, $value = 'id', $label = 'full_name', $columns = [])
    {
        $columns = $columns ?: [$value, $label];

        return $query->select($columns)
            ->get()
            ->map(function ($item) use ($value, $label) {
                return [
                    'value' => $item->{$value},
                    'label' => $item->{$label},
                ];
            });
    }
}
