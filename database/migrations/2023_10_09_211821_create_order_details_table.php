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
        Schema::create('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->char('item_id', 6);

            $table->integer('quantity');
            $table->string('note', 200)->nullable(true);
            $table->boolean('status')->default(false);

            $table->primary(['order_id', 'item_id']);

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('item_id')->references('id')->on('items');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
