<?php

namespace App\Helper;

class ColorStatus
{
    public static function getTotalColor($total): string
    {
        $case = match (true) {
            $total < 10 => 'low',
            $total < 50 => 'medium',
            default => 'high'
        };

        return match ($case) {
            'low' => 'bg-red-500 text-white',
            'medium' => 'bg-yellow-500',
            'high' => 'bg-green-500'
        };
    }
}
