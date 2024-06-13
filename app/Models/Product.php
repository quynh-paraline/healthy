<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Table;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";
    protected $fillable = [
        "name",
        "price",
        "qty",
        "thumbnail",
        "description",
        "category_id"
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, "order_products")->withPivot("buy_qty", "expense");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
