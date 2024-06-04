<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schedule;

// Schedule::command('app:refresh-cars')->dailyAt('00:00');
Schedule::command('app:refresh-cars')->everyMinute();
