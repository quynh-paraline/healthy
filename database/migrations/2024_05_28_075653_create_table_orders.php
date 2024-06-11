<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("full_name", 50);
            $table->string("email", 50);
            $table->string("phone_number", 20);
            $table->string("city");
            $table->string("address");
            $table->decimal("expense", 14, 2);
            $table->tinyInteger("status")->default(0);
            $table->string("payment_method", 20);
            $table->boolean("is_paid")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
