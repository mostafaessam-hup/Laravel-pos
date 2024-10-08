<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'capitalized_name',
        'iso',
        'iso3',
        'num_code',
        'phone_code',
    ];
}
