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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();

            $table->string('disk')->nullable();
            $table->text('name')->nullable();
            $table->text('hash')->nullable();
            $table->string('upload_type')->nullable();
            $table->text('path')->nullable();
            $table->unsignedBigInteger('size')->nullable();

            /**
             * $table->morphs() создает 2 поля:
             * @var int $uploadable_id
             * @var string $uploadable_type
             */
            $table->morphs('uploadable');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
