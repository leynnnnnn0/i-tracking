<?php

namespace App\Helper;

class ColorStatus
{
    public static function getTotalColor($total): string
    {
        switch ($total) {
            case $total == 0:
                return 'bg-red-500 border-red-500';
            case $total < 10:
                return 'bg-red-500 border-red-500';
            case $total < 20:
                return 'bg-orange-500 border-orange-500';
            case $total >= 20:
                return 'bg-green-500 border-green-500';
            default:
                return 'bg-green-500 border-green-500';
        }
    }
}
