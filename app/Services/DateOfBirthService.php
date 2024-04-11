<?php

namespace App\Services;

use App\Enums\DayOfWeekEnum;
use App\Enums\AgeCategoryEnum;
use RuntimeException;

class DateOfBirthService
{
    private DateTimeService $dateTimeService;

    public function __construct(string $birthday)
    {
        $this->dateTimeService = new DateTimeService($birthday);
    }

    public function ageToPlainText(): string
    {
        $age = $this->dateTimeService->calculateAge();

        if ($age <= 17) {
            return AgeCategoryEnum::Young->value;
        }

        if ($age <= 59) {
            return AgeCategoryEnum::Adult->value;
        }

        return AgeCategoryEnum::Senior->value;
    }

    public function generateAnswer(string $weekdayName): string
    {
        $amount = $this->calculateAmountOfWeekdays($weekdayName);
        $weekdayNameForm = $amount !== 1 ? $weekdayName . 's' : $weekdayName;

        return "This person lived " . $amount . " " . lcfirst($weekdayNameForm) . " so far.";
    }

    public function calculateAmountOfWeekdays(string $weekdayName): int
    {
        $weekdayName = ucfirst($weekdayName);

        if (!in_array($weekdayName, DayOfWeekEnum::names(), true)) {
            throw new RuntimeException('Provided weekday does not exist');
        }

        $weekdayNumber = DayOfWeekEnum::getValue($weekdayName);

        return $this->dateTimeService->calculateAmountOfWeekdays($weekdayNumber);
    }

}
