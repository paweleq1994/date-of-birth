<?php
require_once "autoloader.php";

use App\DateOfBirth;

$personDOB = new DateOfBirth('27-09-1994');

echo $personDOB->getPlainTextAge();
echo '<br>';
echo $personDOB->countWeekDays('Monday');
