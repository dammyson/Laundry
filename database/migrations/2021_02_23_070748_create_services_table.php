<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->default('');
            $table->integer('washing_price')->default(0);
            $table->integer('ironing_price')->default(0);
            $table->integer('cleaning_price')->default(0);
            $table->integer('exp_washing_price')->default(0);
            $table->integer('exp_ironing_price')->default(0);
            $table->integer('exp_cleaning_price')->default(0);
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
        Schema::dropIfExists('services');
    }
}
