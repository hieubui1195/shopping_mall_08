<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('promotion_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('percent')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('promotion_id')->references('id')->on('promotions')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_details');
    }
}
