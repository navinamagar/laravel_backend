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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('cartcode');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('number');
            $table->string('area_id');
            $table->enum('paymenttype', ['esewa', 'cod']);
            $table->integer('productcost');
            $table->integer('shippingcost');
            $table->integer('grandtotal');
            $table->enum('paymentstatus', ['Paid', 'Unpaid'])->default('Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
