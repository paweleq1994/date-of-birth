<?php

namespace App\Enums;
enum DayOfWeekEnum: int
{
    case Monday = 1;
    case Tuesday = 2;
    case Wednesday = 3;
    case Thursday = 4;
    case Friday = 5;
    case Saturday = 6;
    case Sunday = 7;


    public static function names(): array {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function getValue(string $weekdayName): int
    {
        return array_flip(self::array())[$weekdayName];
    }
}
