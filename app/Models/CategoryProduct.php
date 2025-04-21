<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $fillable = [
        'name', 'slug', 'title_seo', 'description_seo', 'meta_keywords', 'image_url', 'status', 'sort_order',
        'parent_id', 'is_show_home', 'icon', 'is_show_menu'
    ];

    // Quan hệ danh mục cha
    public function parent()
    {
        return $this->belongsTo(CategoryProduct::class, 'parent_id');
    }

    // Quan hệ danh mục con
    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function totalProductsCount()
    {
        // Lấy số lượng sản phẩm của danh mục hiện tại
        $count = $this->products()->count();

        // Đệ quy để lấy số lượng sản phẩm của các danh mục con
        foreach ($this->children as $child) {
            $count += $child->totalProductsCount();
        }

        return $count;
    }
}
