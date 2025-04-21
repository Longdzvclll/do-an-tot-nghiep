<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Có thể null nếu người mua không đăng nhập
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_phone',
        'billing_email',
        'total_amount',
        'status', // Trạng thái đơn hàng như: pending, completed, canceled
        'payment_method', // Phương thức thanh toán: COD, bank_transfer, etc.
        'order_notes', // Ghi chú đơn hàng
        'updated_at',
        'created_at',
    ];

    // Quan hệ với OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Quan hệ với User nếu người mua đăng nhập
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
