<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_produk');
            $table->foreignId('id_transaksi');
            $table->integer('jumlah');
            $table->bigInteger('subtotal');
            $table->foreign('id_produk')
                    ->references('id_produk')
                    ->on('produk');
            $table->foreign('id_transaksi')
                    ->references('id_transaksi')
                    ->on('transaksi');
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
        Schema::dropIfExists('detail_transaksi');
    }
}
