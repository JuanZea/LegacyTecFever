<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmutableProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immutable_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('amount');
            $table->string('category');
            $table->string('image')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            // Relations

            $table->foreign('payment_id')->references('id')->on('payments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immutable_products');
    }
}

