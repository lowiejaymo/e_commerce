<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'supplier_id'; 

    protected $fillable = ['supplier_id', 'name', 'contact_num', 'address', 'email']; 
}
