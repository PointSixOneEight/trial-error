<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name')->nullable();
            $table->string('price')->nullable()->default('0');
            $table->string('amount')->nullable()->default('0');
            $table->string('buy_fee')->nullable()->default('0');
            $table->string('price_sold')->nullable()->default('0');
            $table->string('sell_fee')->nullable()->default('0');
            $table->string('realize_pnl')->nullable()->default('0');
            $table->string('status')->nullable();
            $table->string('buy_date')->nullabe();
            $table->string('sell_date')->nullabe();
            $table->string('leverage')->nullabe();
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
        Schema::dropIfExists('users');
    }
}
