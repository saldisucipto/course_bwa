<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_items', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('users_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('transactions_id')->unsigned();
            $table->bigInteger('quantity');

            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('transactions_id')->references('id')->on('transactions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_items');
    }
}
