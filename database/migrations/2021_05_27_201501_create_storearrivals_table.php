<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorearrivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storearrivals', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->string('supplier');

            $table->string('stock_type');
            $table->string('item_name');

            $table->float('quantity');


            $table->float('approvedquantity')->default(0);
            $table->float('rejectedquantity')->default(0);
            $table->string('disposedstatus')->default('0');
            $table->float('price');

            $table->string('invoice')->default('0');
            $table->string('invoice_date');
            $table->string('Dc_no')->default('0000');

            $table->date('Dc_date');
            $table->string('section');

            $table->string('arrivals_page_no')->default(0);
            $table->string('sign_of_ask')->default('1');

            $table->string('sign_of_insp_officer')->default('0');

            $table->string('store_officer')->default('0');
            $table->string('gem_officer')->default('0');

            $table->text('remarks');
            $table->text('rejectionremarks');
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
        Schema::dropIfExists('storearrivals');
    }
}
