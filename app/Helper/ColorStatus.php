<?php

namespace App\Helper;

class ColorStatus
{
    public static function getTotalColor($total): string
    {
        switch ((int)$total) {
            case $total <= 10:
                return 'bg-red-500 border-red-500';
            case $total < 20:
                return 'bg-orange-500 border-orange-500';
            case $total < 1000:
                return 'bg-primary border-primary';
            default:
                return 'bg-red-500 border-red-500';
        }
    }
}
