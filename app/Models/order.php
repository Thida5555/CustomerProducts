<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // បញ្ជាក់វាលfillable ត្រឹមត្រូវ
    protected $fillable = ['customer_id', 'order_date', 'total_price'];

    // Order belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Order has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
