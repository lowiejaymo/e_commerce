<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'product_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function priceAfterDiscount($percentage)
    {
        $discount = ($this->price * $percentage) / 100;
        return $this->price - $discount;
    }

    public function isInStock()
    {
        return $this->stock > 0;
        
    }
}