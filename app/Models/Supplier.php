<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it follows Laravel's naming convention)
    protected $table = 'suppliers';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'contact_info',
    ];

    /**
     * Define relationships
     */

    // Example: A supplier may supply many products
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

