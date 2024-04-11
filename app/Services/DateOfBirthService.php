<?php

namespace app\Services;

use DateTime;

use app\Enums\DayOfWeekEnum;
use app\Enums\AgeCategoryEnum;
use RuntimeException;

class DateOfBirthService
{
    public function __construct(private readonly string $birthday)
    {
    }

    public function ageToPlainText($age): string
    {
        if ($age <= 17) {
            return AgeCategoryEnum::Young->value;
        } elseif ($age >= 18 && $age <= 59) {
            return AgeCategoryEnum::Adult->value;
        } else {
            return AgeCategoryEnum::Senior->value;
        }
    }

    public function generateAnswer($weekdayName, $amount): string
    {
        $weekdayNameForm = $amount !== 1 ? $weekdayName . 's' : $weekdayName;

        return "This person lived " . $amount . " " . lcfirst($weekdayNameForm) . " so far.";
    }

    public function calculateAmountOfWeekdays($weekdayName): int
    {
        $weekdayName = ucfirst($weekdayName);

        if (!in_array($weekdayName, DayOfWeekEnum::names(), true)) {
            throw new RuntimeException('Provided weekday does not exist');
        }

        $weekdayNumber = DayOfWeekEnum::getValue($weekdayName) + 1;

        $birthday = new DateTime($this->birthday);
        $amountOfDays = 0;
        $now = new DateTime();

        while ($birthday <= $now) {
            if ($birthday->format('N') == $weekdayNumber) {
                $amountOfDays++;
            }

            $birthday->modify('+1 day');
        }

        return $amountOfDays;
    }

    public function calculateAge(): int
    {
        $now = new DateTime();
        $birthday = new DateTime($this->birthday);

        return $now->diff($birthday)->y;
    }
}
