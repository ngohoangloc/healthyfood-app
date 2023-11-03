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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('fullName', 50);
            $table->string('address', 100);
            $table->char('phone', 10);
            $table->boolean('active')->default(true);

            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');

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
        Schema::dropIfExists('users');
    }
};
