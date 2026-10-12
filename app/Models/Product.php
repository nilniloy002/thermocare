<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'family', 'brand', 'summary', 'image', 'is_published'];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }
}
