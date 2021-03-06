<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrancesTable extends Migration
{
    public function up()
    {
        Schema::create('entrances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reception');
            $table->integer('quantity');
            $table->string('unity_m');
            $table->string('date');
            $table->string('supplier');
            $table->integer('price');
            $table->string('commentary')->nullable();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entrances');
    }
}
