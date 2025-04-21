<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'status', 
        'sort_order',
        'is_show_menu',
        'is_show_home',
        'title_seo',
        'description_seo'
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
