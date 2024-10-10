<?php

namespace App\Enum;


enum OrganizationUnit: string
{
    case RAndE = "R & E";

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
