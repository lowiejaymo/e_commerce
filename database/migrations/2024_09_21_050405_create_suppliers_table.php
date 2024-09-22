<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            // Create columns
            $table->id('supplier_id'); 
            $table->string('name');
            $table->string('contact_num');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}