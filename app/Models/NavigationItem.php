<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = ['parent_id', 'label', 'url', 'description', 'icon', 'location', 'menu_type', 'menu_group', 'promo_title', 'promo_text', 'promo_button_label', 'promo_button_url', 'sort_order', 'is_visible', 'open_in_new_tab'];

    protected function casts(): array
    {
        return ['is_visible' => 'boolean', 'open_in_new_tab' => 'boolean'];
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }
}
