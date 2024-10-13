<?php

namespace App\Enum;

enum EquipmentStatus: string
{
    case ACTIVE = 'Active';
    case BORROWED = 'Borrowed';
    case CONDEMND = 'Condemnd';

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }

    public static function getColor($status)
    {
        return match ($status) {
            'Active' => 'bg-green-500 border-green-500',
            'Borrowed' => 'bg-gray-300 border-gray-300',
            'Condemnd' => 'bg-red-500 border-red-500'
        };
    }
}
