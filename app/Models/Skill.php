<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'percent',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'percent' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
