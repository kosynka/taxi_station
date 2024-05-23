<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_id',
        'type',
        'received_date',
        'paid_date',
        'amount',
        'status',
        'comments',
        'protocol_file_path',
    ];

    protected function received(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['received_date']
                ? Carbon::parse($attributes['received_date'])
                : null,
        );
    }

    protected function paid(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['paid_date']
                ? Carbon::parse($attributes['paid_date'])
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
