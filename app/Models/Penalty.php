<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_id',
        'received_at',
        'paid_at',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'received_at' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }
}
