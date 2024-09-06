<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'price',
        'quantity',
        'category',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class , 'order_product');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
