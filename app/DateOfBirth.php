<?php

namespace app;

use DateTime;
use DateTimeZone;
use app\Services\DateOfBirthService;
use RuntimeException;

class DateOfBirth extends DateTime
{
    private DateOfBirthService $dateOfBirthService;

    public function __construct(
        private readonly string $birthday,
        string                  $datetime = 'now',
        ?DateTimeZone           $timezone = null
    )
    {
        parent::__construct($datetime, $timezone);

        $now = new DateTime();

        if ($this->birthday > $now) {
            throw new RuntimeException('Your birthday cannot be greater than now');
        }

        $this->dateOfBirthService = new DateOfBirthService($this->birthday);
    }

    public function getPlainTextAge(): string
    {
        $age = $this->dateOfBirthService->calculateAge();

        return $this->dateOfBirthService->ageToPlainText($age);
    }

    public function countWeekdays($weekdayName): string
    {
        $weekdaysAmount = $this->dateOfBirthService->calculateAmountOfWeekdays($weekdayName);

        return $this->dateOfBirthService->generateAnswer($weekdayName, $weekdaysAmount);
    }
}
