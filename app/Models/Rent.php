<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'driver_id',
        'start_date',
        'end_at',
        'amount',
        'contract_file_path',
    ];

    protected function casts(): array
    {
        return ['start_date' => 'date:d.m.Y'];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function penalty(): HasOne
    {
        return $this->hasOne(Penalty::class, 'rent_id', 'id');
    }
}
