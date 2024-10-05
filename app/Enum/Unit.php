<?php

namespace App\Enum;

enum Unit: string
{
    case pcs = 'pcs';
    case pack = 'pack';

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
