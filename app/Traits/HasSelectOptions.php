<?php

namespace App\Traits;

trait HasSelectOptions
{
    public function scopeToSelectOptions($query, $label = 'name', $value = 'id',  $columns = [])
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
