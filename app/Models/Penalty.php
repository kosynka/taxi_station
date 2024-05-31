<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Commentable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalty extends Model
{
    use HasFactory;
    use Commentable;

    protected $fillable = [
        'rent_id',
        'type',
        'received_at',
        'paid_at',
        'amount',
        'status',
        'comments',
        'protocol_file_path',
    ];

    protected function casts(): array
    {
        return [
            'comments' => 'array',
        ];
    }

    protected function received(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['received_at']
                ? Carbon::parse($attributes['received_at'])
                : null,
        );
    }

    protected function paid(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['paid_at']
                ? Carbon::parse($attributes['paid_at'])
                : null,
        );
    }

    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }

    public static function getTypes(): array
    {
        return [
            'fine' => 'Штраф',
            'accident' => 'ДТП',
        ];
    }

    public function getType(): ?array
    {
        return match ($this->type) {
            'fine' => ['warning', 'Штраф'],
            'accident' => ['danger', 'ДТП'],
        };
    }

    public static function getStatuses(): array
    {
        return [
            'unpaid' => 'Не оплатил',
            'paid_with_discount' => 'Оплатил со скидкой 50%',
            'paid_without_discount' => 'Оплатил 100%',
        ];
    }

    public function getStatus(): ?array
    {
        return match ($this->status) {
            'unpaid' => ['danger', 'Не оплатил'],
            'paid_with_discount' => ['success', 'Оплатил со скидкой 50%'],
            'paid_without_discount' => ['success', 'Оплатил 100%'],
        };
    }
}
