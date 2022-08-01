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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('billing_name');
            $table->string('billing_email');
            $table->bigInteger('billing_phone');
            $table->integer('billing_country');
            $table->integer('billing_city');
            $table->bigInteger('billing_zipcode');
            $table->string('billing_address');
            $table->longText('order_note')->nullable();
            $table->string('payment_method');
            $table->string('payment_status');
            $table->boolean('coupon')->default(false);
            $table->string('coupon_code')->nullable();
            $table->string('coupon_value')->nullable();
            $table->integer('coupon_amount')->default(0);
            $table->integer('order_subtotal');
            $table->integer('order_total');
            $table->integer('order_shipping');
            $table->float('order_vat');
            $table->integer('vat_value')->default(0);
            $table->string('order_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
