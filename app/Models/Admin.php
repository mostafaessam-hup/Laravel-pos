<?php

namespace App\Models;

use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, LaratrustUserTrait;
    protected $guarded = [];
    protected $fillable = [
        'full_name',
        'email',
        'country_code',
        'phone',
        'password',
        'active',
        'country_id',
        'language_id',
        'type_id'
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (bcrypt($value)),
        );
    }
}
