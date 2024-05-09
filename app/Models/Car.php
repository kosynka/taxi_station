<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'deposit',
        'rent_sum',
    ];

    public function oilChanges(): HasMany
    {
        return $this->hasMany(OilChange::class, 'car_id', 'id');
    }

    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class, 'car_id', 'id');
    }

    public function today()
    {
        return $this->rents()->whereDate('start_at', '>=', now()->format('Y-m-d'))->first();
    }

    public function getStatus(): array
    {
        return match ($this->status) {
            'on_rent' => ['success', 'На прокате'],
            'in_parking' => ['danger', 'На стоянке'],
            'at_service' => ['warning', 'На сервисе'],
            'parking_fine' => ['secondary', 'На штраф стоянке'],
            default => ['light', 'Неизвестно'],
        };
    }
}
