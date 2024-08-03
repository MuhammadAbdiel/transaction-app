<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sales', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 15)->unique();
            $table->dateTime('tgl');
            $table->unsignedBigInteger('cust_id')->index();
            $table->double('subtotal');
            $table->double('diskon');
            $table->double('ongkir');
            $table->double('total_bayar');
            $table->timestamps();

            $table->foreign('cust_id')->references('id')->on('m_customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_sales');
    }
}
