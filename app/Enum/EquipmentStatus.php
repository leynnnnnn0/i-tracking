<?php

namespace App\Enum;

enum EquipmentStatus: string
{
    case ACTIVE = 'active';
    case PARTIALLY_BORROWED = 'partially_borrowed';
    case FULLY_BORROWED = 'fully_borrowed';
    case CONDEMNED = 'condemned';

    public static function labels(): array
    {
        return [
            self::ACTIVE->value => 'Active',
            self::PARTIALLY_BORROWED->value => 'Partially Borrowed',
            self::FULLY_BORROWED->value => 'Fully Borrowed',
        ];
    }

    public static function values()
    {
        $data = array_column(self::cases(), 'value');
        return array_combine($data, $data);
    }

    public static function getColor($status)
    {
        return match ($status->value) {
            self::PARTIALLY_BORROWED->value => 'bg-yellow-500 border-yellow-500 text-white',
            self::FULLY_BORROWED->value => 'bg-orange-500 border-orange-500 text-white',
            self::ACTIVE->value => 'bg-green-500 border-green-500 text-white',
            default => 'bg-red-500 border-red-500 text-white'
        };
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }
}
