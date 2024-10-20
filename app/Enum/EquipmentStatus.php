<?php

namespace App\Enum;

enum EquipmentStatus: string
{
    case ACTIVE = 'Active';
    case BORROWED = 'Borrowed';

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }

    public static function getColor($status)
    {
        return match ($status) {
            'Borrowed' => 'bg-orange-500 border-orange-500 text-white',
            'Active' => 'bg-green-500 border-green-500 text-white',
            'Condemned' => 'bg-red-500 border-red-500 text-white'
        };
    }
}
