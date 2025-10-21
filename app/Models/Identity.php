<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    protected $fillable = [
        'sinner',
        'identity_name',
        'rarity',
        'damage_type',
        'specialties',
        'image_url',
        'season',
        'is_base'
    ];

    protected $casts = [
        'specialties' => 'array',
        'damage_types' => 'array',
        'is_base' => 'boolean'
    ];
}
