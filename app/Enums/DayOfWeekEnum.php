<?php

namespace app\Enums;
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

    public static function getValue($weekdayName): int
    {
        return array_flip(self::names())[$weekdayName];
    }
}
