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
        Schema::create('items', function (Blueprint $table) {
            $table->char('id', 6);
            $table->primary('id');

            $table->string('name', 50);
            $table->string('imgPath')->nullable();
            $table->string('desc')->nullable();
            $table->tinyInteger('type');
            $table->float('minInventoryLevel');
            $table->float('maxInventoryLevel');
            $table->boolean('active')->default(true);

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('measurement_units')->cascadeOnDelete();

            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();

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
        Schema::dropIfExists('items');
    }
};
