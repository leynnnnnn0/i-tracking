<?php

namespace App\Enum;

enum BorrowStatus: string
{
    case BORROWED = 'borrowed';
    case PARTIALLY_RETURNED = 'partially_returned';
    case RETURNED = 'returned';
    case PARTIALLY_LOST = 'partially_lost';
    case LOST = 'lost';
    case RETURNED_WITH_LOSS = 'returned_with_loss';
    case PARTIALLY_RETURNED_WITH_LOSS = 'partially_returned_with_loss';
    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }
}
