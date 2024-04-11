<?php

namespace App\Services;

use DatePeriod;
use DateTime;
use DateInterval;

class DateTimeService extends DateTime
{
    public function calculateAge(): int
    {
        $now = new self();

        return $this->diff($now)->y;
    }

    public function calculateAmountOfWeekdays(int $weekdayNumber): int
    {
        $end = new self();
        $period = new DateInterval('P1D');
        $days = 0;

        foreach (new DatePeriod($this, $period, $end) as $day) {
            if ((int)$day->format('N') === $weekdayNumber) {
                $days++;
            }
        }

        return $days;
    }
}
