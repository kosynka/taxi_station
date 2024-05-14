<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_number',
        'brand',
        'model',
        'year',
        'status',
        'mileage',
        'rent_sum',
    ];

    public static $on_rent = 'on_rent';
    public static $in_parking = 'in_parking';
    public static $at_service = 'at_service';
    public static $parking_fine = 'parking_fine';

    public function oilChanges(): HasMany
    {
        return $this->hasMany(OilChange::class, 'car_id', 'id');
    }

    public function lastOilChange(): ?OilChange
    {
        return $this->oilChanges()->orderBy('changed_at', 'desc')->first();
    }

    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class, 'car_id', 'id');
    }

    public function penalties(): HasManyThrough
    {
        return $this->hasManyThrough(
            Penalty::class,
            Rent::class,
            'car_id',
            'rent_id',
            'id',
            'id',
        );
    }

    public function today()
    {
        return $this->rents()->whereDate('start_at', '>=', now()->format('Y-m-d'))->first();
    }

    public static function getStatuses(): array
    {
        return [
            'on_rent' => 'На прокате',
            'in_parking' => 'На стоянке',
            'at_service' => 'На обслуживании',
            'parking_fine' => 'На штраф стоянке',
        ];
    }

    public function getStatus(): ?array
    {
        return match ($this->status) {
            'on_rent' => ['success', 'На прокате'],
            'in_parking' => ['danger', 'На стоянке'],
            'at_service' => ['warning', 'На обслуживании'],
            'parking_fine' => ['secondary', 'На штраф стоянке'],
        };
    }

    public function getLastOilChangeStatus(): string
    {
        $lastOilChange = $this->lastOilChange();

        if ($lastOilChange !== null) {
            $changedAt = $lastOilChange->changed_at;
            $monthsAgo = now()->diffInMonths($changedAt);

            if ($monthsAgo < 3) {
                return 'success';
            } elseif ($monthsAgo < 6) {
                return 'warning';
            } else {
                return 'danger';
            }
        }

        return 'light';
    }
}
