<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_type');
            $table->string('banner_sub_title')->nullable();
            $table->string('banner_title')->nullable();
            $table->string('banner_button')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('banner_slug')->nullable();
            $table->string('banner_image')->default(null);
            $table->boolean('status')->default(false);
            $table->string('url');
            $table->timestamps();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
