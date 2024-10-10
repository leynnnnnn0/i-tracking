<?php

namespace App\Enum;

enum OperatingUnitAndProject : string
{
    case OVPRE = 'OVPRE';
    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
