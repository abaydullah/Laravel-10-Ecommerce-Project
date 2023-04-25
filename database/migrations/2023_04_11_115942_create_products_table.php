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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('quantity')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('code')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('video_link')->nullable();
            $table->integer('main_slider')->default(0);
            $table->integer('hot_deal')->default(0);
            $table->integer('best_rated')->default(0);
            $table->integer('hot_new')->default(0);
            $table->string('image')->nullable();
            $table->text('details')->nullable();
            $table->integer('status')->default(0);
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
