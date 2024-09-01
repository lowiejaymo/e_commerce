<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it follows Laravel's naming convention)
    protected $table = 'categories';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Define relationships
     */

    // Example: A category has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

