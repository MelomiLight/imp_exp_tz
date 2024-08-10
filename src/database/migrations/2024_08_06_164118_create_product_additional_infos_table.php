<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_additional_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('size')->nullable();
            $table->string('colour')->nullable();
            $table->string('brand')->nullable();
            $table->string('structure')->nullable()->comment("Состав товара");
            $table->unsignedInteger('amount_package')->nullable()->comment("Кол-во в упаковке");
            $table->string('seo_title')->nullable();
            $table->string('seo_h1')->nullable();
            $table->text('seo_description')->nullable();
            $table->unsignedInteger('weight_product_g')->nullable()->comment('Вес товара(г)');
            $table->unsignedInteger('width_product_mm')->nullable()->comment('Ширина(мм)');
            $table->unsignedInteger('height_product_mm')->nullable()->comment('Высота(мм)');
            $table->unsignedInteger('length_product_mm')->nullable()->comment('Длина(мм)');
            $table->unsignedInteger('weight_package_g')->nullable()->comment('Вес упаковки(г)');
            $table->unsignedInteger('width_package_mm')->nullable()->comment('Ширина упаковки(мм)');
            $table->unsignedInteger('height_package_mm')->nullable()->comment('Высота упаковки(мм)');
            $table->unsignedInteger('length_package_mm')->nullable()->comment('Длина упаковки(мм)');
            $table->string('category')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_additional_infos');
    }
};
