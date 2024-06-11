<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        "full_name",
        "email",
        "phone_number",
        "address",
        "city",
        "expense",
        "payment_method",
        "is_paid",
        "status",

    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, "order_products")->withPivot("buy_qty", "expense");
    }
}
