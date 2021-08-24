<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeprecatedStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deprecated_stocks', function (Blueprint $table) {
            $table->id();

            $table->string('product_id');
            $table->string('item_id');
            $table->string('section_name');
            $table->float('deprecated_quantity');
         
            $table->string('status')->default('0');



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
        Schema::dropIfExists('deprecated_stocks');
    }
}
