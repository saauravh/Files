<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'tempname',
        'name',
        'title',
        'slug',
        'is_default',
        'secs',
        'seo_content',
    ];

    protected $casts = [
        'seo_content' => 'object',
        'secs' => 'object',
    ];
}
