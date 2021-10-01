<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_user');
            $table->string('kode_transaksi')->nullable();
            $table->bigInteger('harga_total');
            $table->string('status_transaksi')->default('keranjang');
            $table->string('kurir')->nullable();
            $table->bigInteger('biaya')->nullable();
            $table->string('jasa')->nullable();
            $table->string('etd')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('resi')->nullable();
            $table->foreign('id_user')
                    ->references('id')
                    ->on('users');
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
        Schema::dropIfExists('transaksi');
    }
}
