<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'phone',

        'balance',

        'iin',
        'id_doc_number',
        'id_doc_date',
        'id_doc_until_date',
        'registration_address',             // Адрес прописки
        'residence_address',                // Адрес проживания

        'driver_license_number',
        'driver_license_date',
        'driver_license_categories',

        'id_doc_photo_1',
        'id_doc_photo_2',

        'driver_license_photo_1',
        'driver_license_photo_2',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class, 'driver_id', 'id')
            ->orderBy('start_at', 'desc');
    }

    public function penalties(): HasManyThrough
    {
        return $this->hasManyThrough(
            Penalty::class,
            Rent::class,
            'driver_id',
            'rent_id',
            'id',
            'id',
        )
        ->orderBy('received_date', 'desc');
    }

    public function roleIs(string $role = 'admin'): bool
    {
        return $this->role === $role;
    }
}
