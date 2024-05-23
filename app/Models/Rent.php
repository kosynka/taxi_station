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
        'start_at',
        'end_at',
        'amount',
        'comments',
        'contract_file_path',
        'contract_with_buy_file_path',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'comments' => 'array',
        ];
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

    public function addComment(array $changes): void
    {
        $comments = $this->comments ?? [];

        $id = count($comments) + 1;

        $new_comment = [
            $id => [
                'id' => $id,
                'text' => $changes['text'],
                'old_status' => $this->status,
                'new_status' => $changes['status'],
                'user_id' => auth()->user()->id,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]
        ];

        $this->comments = $comments + $new_comment;
    }

    public function getLastComment(): array|bool
    {
        $comments = $this->comments ?? [];

        if (empty($comments)) {
            return false;
        }

        return end($comments);
    }
}
