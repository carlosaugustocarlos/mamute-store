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
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('stock_quantity');
            $table->string('photo_path')->nullable();
            $table->timestamps();

            $table->index(['store_id', 'name']);
            $table->index(['price', 'stock_quantity']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
