<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
    ];
    public $timestamps = false;

    // Liên kết với đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Liên kết với sản phẩm (tùy theo hệ thống)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
