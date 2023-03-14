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
            $table->integer("order_number");
            $table->decimal('total_price',10,2);
            $table->decimal('discount_amount',10,2);
            $table->decimal('amount_to_be_paid',10,2);
            $table->string('campain_info');
            $table->timestamps();
            $table->enum('status',['active','passive'])->default('active');
            $table->enum('deleted',['not_delete','deleted'])->default('not_delete');
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
