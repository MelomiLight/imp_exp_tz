<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('external_code')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price')->nullable()->comment('Цена');
            $table->string('currency_price')->nullable()->comment('Валюта цены');
            $table->decimal('purchase_price')->nullable()->comment('Закупочная цена');
            $table->string('currency_purchase_price')->nullable()->comment('Валюта закупочной цены');
            $table->decimal('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
