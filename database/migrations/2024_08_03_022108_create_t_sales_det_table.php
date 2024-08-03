<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSalesDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sales_det', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id')->index();
            $table->unsignedBigInteger('barang_id')->index();
            $table->double('harga_bandrol')->comment('Harga sebelum diskon');
            $table->integer('qty')->comment('Jumlah barang');
            $table->double('diskon_pct')->comment('Diskon dalam persen');
            $table->double('diskon_nilai')->comment('Diskon dalam rupiah');
            $table->double('harga_diskon')->comment('Harga setelah diskon');
            $table->double('total')->comment('Total harga');
            $table->timestamps();

            $table->foreign('sales_id')->references('id')->on('t_sales')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('m_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_sales_det');
    }
}
