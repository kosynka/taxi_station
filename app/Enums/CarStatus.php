<?php

declare(strict_types=1);

namespace App\Enums;

enum CarStatus: string
{
    case OnRent = [
        'name' => 'on_rent',
        'text' => 'На прокате',
    ];
    case InParking = [
        'name' => 'in_parking',
        'text' => 'На стоянке',
    ];
    case AtService = [
        'name' => 'at_service',
        'text' => 'На обслуживании',
    ];
    case ParkingFine = [
        'name' => 'parking_fine',
        'text' => 'На штраф стоянке',
    ];
}
