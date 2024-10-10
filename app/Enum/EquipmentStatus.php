<?php

namespace App\Enum;

enum EquipmentStatus: string
{
    case ACTIVE = 'Active';
    case BORROWED = 'Borrowed';
    case CONDEMND = 'Condomend';

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
