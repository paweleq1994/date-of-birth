<?php

namespace App;

use App\Services\DateOfBirthService;

class DateOfBirth
{
    private DateOfBirthService $dateOfBirthService;

    public function __construct(private readonly string $birthday)
    {
        $this->dateOfBirthService = new DateOfBirthService($this->birthday);
    }

    public function getPlainTextAge(): string
    {
        return $this->dateOfBirthService->ageToPlainText();
    }

    public function countWeekdays(string $weekdayName): string
    {
        return $this->dateOfBirthService->generateAnswer($weekdayName);
    }
}
