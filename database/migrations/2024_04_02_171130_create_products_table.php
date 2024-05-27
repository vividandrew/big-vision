<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Barcode')->nullable();
            $table->double('Price');
            $table->unsignedInteger('Stock');
            $table->string('Name');
            $table->string('Description')->nullable();
            $table->string('Platform')->nullable();
            $table->integer('GroupId')->nullable();
            $table->double('Discount')->nullable();
            $table->string('ImageUrl')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
