<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'price',
        'stock',
        'sku',
        'category_id',
        'slug'
    ];

    // Quan hệ với danh mục sản phẩm
    public function categories()
    {
        return $this->belongsToMany(CategoryProduct::class, 'product_category', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }

}

