<?php
require_once "autoloader.php";

use app\DateOfBirth;

$personDOB = new DateOfBirth('06.04.2024');

echo $personDOB->getPlainTextAge();
echo '<br>';
echo $personDOB->countWeekDays('Friday');
