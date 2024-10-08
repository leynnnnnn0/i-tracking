<?php

namespace App\Enum;

enum MissingStatus: string
{
    case FOUND = 'found';
    case LOST = 'lost';
    case UNDER_INVESTIGATION = 'under investigation';
    case PRESUMED_LOST = 'presumed lost';
    case CONDEMND = 'condemnd';

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
