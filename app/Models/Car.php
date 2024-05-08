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
}
