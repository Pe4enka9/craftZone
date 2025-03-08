<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->float('price');
            $table->unsignedBigInteger('category_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('seller_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('seller_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
