<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'slug', 'location', 'summary', 'image', 'completed_at', 'is_published'];

    protected function casts(): array
    {
        return ['completed_at' => 'date', 'is_published' => 'boolean'];
    }
}
