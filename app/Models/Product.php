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
        'product_discount',
        'stock',
        'product_image',
        'supplier_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
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