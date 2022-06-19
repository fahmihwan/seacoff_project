<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->string('nota')->unique();
            $table->foreignId('meja_id');
            $table->string('nama');
            $table->string('id_transaksi'); //midtrans
            $table->string('id_pemesanan'); //midtran
            $table->enum('status_pemesanan', ['order', 'waiting', 'finish']);
            $table->string('status_pembayaran');  //[order,process, finish]
            $table->string('tipe_pembayaran'); //midtran
            $table->string('kode_pembayaran')->nullable(); //midtrans
            $table->string('pdf_url')->nullable();   //midtrans
            $table->integer('total_harga');
            $table->integer('ppn');
            $table->integer('total_bayar'); //midtrans

            $table->integer('uang_tunai')->nullable();
            $table->integer('kembalian')->nullable();
            $table->timestamps();


            // $table->id();
            // $table->string('status');
            // $table->string('name');
            // $table->string('email');
            // $table->string('number');
            // $table->string('transaction_id');
            // $table->string('order_id');
            // $table->string('gross_amount');
            // $table->string('payment_type');
            // $table->string('payment_code')->nullable();
            // $table->string('pdf_url')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_orders');
    }
};
