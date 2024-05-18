<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_number',
        'vin',
        'carcass',
        'brand',
        'model',
        'engine_capacity',
        'year',
        'color',
        'mileage',
        'amount',
        'status',

        'photo_1',
        'photo_2',
        'photo_3',
        'photo_4',
        'photo_5',
        'photo_6',
        'photo_7',
        'photo_8',
        'photo_9',
        'photo_10',
    ];

    public function oilChanges(): HasMany
    {
        return $this->hasMany(OilChange::class, 'car_id', 'id')
            ->orderBy('changed_at', 'desc');
    }

    public function lastOilChange(): ?OilChange
    {
        return $this->oilChanges()->first();
    }

    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class, 'car_id', 'id')
            ->orderBy('start_date', 'desc');
    }

    public function todayRent(): ?Model
    {
        return $this->rents()
            ->whereDate('start_date', '=', now()->toDateString())
            ->first();
    }

    public function historyRent(): Collection
    {
        return $this->rents()
            ->whereDate('start_date', '<=', now()->toDateString())
            ->get();
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
        )->orderBy('received_date', 'desc');
    }

    public const ON_RENT = 'on_rent';
    public const IN_PARKING = 'in_parking';
    public const AT_SERVICE = 'at_service';
    public const PARKING_FINE = 'parking_fine';

    public static function getStatuses(): array
    {
        return [
            self::ON_RENT => 'На прокате',
            self::IN_PARKING => 'На стоянке',
            self::AT_SERVICE => 'На обслуживании',
            self::PARKING_FINE => 'На штраф стоянке',
        ];
    }

    public function getStatus(): ?array
    {
        return match ($this->status) {
            self::ON_RENT => ['success', 'На прокате'],
            self::IN_PARKING => ['danger', 'На стоянке'],
            self::AT_SERVICE => ['warning', 'На обслуживании'],
            self::PARKING_FINE => ['secondary', 'На штраф стоянке'],
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
