<?php

namespace App\Enum;

enum Position: string
{
    case IT = 'Information Technology';
    case HR = 'Human Resources';
    case FINANCE = 'Finance';
    case MARKETING = 'Marketing';
    case SALES = 'Sales';

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
