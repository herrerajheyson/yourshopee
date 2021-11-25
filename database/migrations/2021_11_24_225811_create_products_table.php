<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 50);
            $table->string('name', 200);
            $table->string('brand', 50);
            $table->decimal('price', 10, 2);
            $table->integer('amount')->default(0);
            $table->integer('discount')->default(0);
            $table->string('reference', 200)->nullable()->default(null);
            $table->string('image', 200)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
