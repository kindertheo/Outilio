<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->date('date');
            $table->integer('price');
            $table->boolean('delivery_option');
            $table->boolean('is_accepted')->default(false);
            $table->boolean('is_processed')->default(false);
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->string('customer_firstname');
            $table->string('customer_lastname');
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
}
