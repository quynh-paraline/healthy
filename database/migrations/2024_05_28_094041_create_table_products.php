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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 110);
            $table->decimal("price", 14, 2);
            $table->integer("qty");
            $table->string("thumbnail");
            $table->text("description")->nullable();
            $table->unsignedBigInteger("category_id");
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign("category_id")->references("id")->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
