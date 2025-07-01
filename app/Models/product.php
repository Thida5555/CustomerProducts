<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock'];

    // Product has many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
