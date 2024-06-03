<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDebt extends Model
{
    use HasFactory;

    protected $table = 'users_debts';

    protected $fillable = [
        'user_id',
        'amount',
        'comment',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStatus(): string
    {
        return match ($this->status) {
            'repaid' => 'вернул',
            'not_repaid' => 'не вернул',
        };
    }
}
