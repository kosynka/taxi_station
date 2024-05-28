<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Car extends Model
{
    use HasFactory;
    use Commentable;

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

        'comments',
    ];

    protected function casts(): array
    {
        return [
            'comments' => 'array',
        ];
    }

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
            ->orderBy('start_at', 'desc');
    }

    public function todayRent(): ?Model
    {
        return $this->rents()
            ->whereDate('start_at', '=', now()->toDateString())
            ->first();
    }

    public function yesterdayRent(): ?Model
    {
        return $this->rents()
            ->whereDate('start_at', '=', date('Y-m-d', strtotime("-1 days")))
            ->first();
    }

    public function historyRent(): Collection
    {
        return $this->rents()
            ->whereDate('start_at', '<=', now()->toDateString())
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
        )->orderBy('received_at', 'desc');
    }

    public function shortDescription(): string
    {
        return $this->state_number . ' ' . $this->brand . ' ' . $this->model;
    }

    public const EMPTY = 'empty';
    public const PASSED = 'passed';
    public const ON_RENT = 'on_rent';
    public const IN_PARKING = 'in_parking';
    public const AT_SERVICE = 'at_service';
    public const PARKING_FINE = 'parking_fine';
    public const AT_OWNER = 'at_owner';
    public const WEEKEND = 'weekend';
    public const ACCIDENT = 'accident';

    public static function getStatuses(): array
    {
        return [
            self::ON_RENT => 'На линии',
            self::PASSED => 'Сдан',
            self::IN_PARKING => 'На парковке',
            self::AT_SERVICE => 'На СТО',
            self::PARKING_FINE => 'Штраф стоянка',
            self::AT_OWNER => 'У инвестора',
            self::WEEKEND => 'Выходной',
            self::ACCIDENT => 'Аварийная ДТП',
        ];
    }

    public static function getStatusesForUpdate(): array
    {
        return [
            self::IN_PARKING => 'На парковке',
            self::AT_SERVICE => 'На СТО',
            self::PARKING_FINE => 'Штраф стоянка',
            self::AT_OWNER => 'У инвестора',
            self::WEEKEND => 'Выходной',
            self::ACCIDENT => 'Аварийная ДТП',
        ];
    }

    public function getStatus(string $status = null): ?array
    {
        return match ($status ?? $this->status) {
            self::EMPTY => ['info', 'Не проставлен'],
            self::PASSED => ['primary', 'Сдан'],
            self::ON_RENT => ['success', 'На линии'],
            self::IN_PARKING => ['secondary', 'На парковке'],
            self::AT_SERVICE => ['warning', 'На СТО'],
            self::PARKING_FINE => ['secondary', 'Штраф стоянка'],
            self::AT_OWNER => ['primary', 'У инвестора'],
            self::WEEKEND => ['primary', 'Выходной'],
            self::ACCIDENT => ['danger', 'Аварийная ДТП'],
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

    public function getLastOilChangeMileage(): int
    {
        $lastOilChange = $this->lastOilChange();

        return $lastOilChange?->mileage ?? 0;
    }
}
