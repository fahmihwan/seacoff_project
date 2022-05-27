<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailOrders>
 */
class DetailOrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'meja_id' => rand(1, 3),
            'status' => 'pendding',
            'id_transaksi' => 'qweqwe23232',
            'tipe_pembayaran' => 'gopay-insert',
            'id_pemesanan' => 'ds23232s2s2s',
            'kode_pembayaran' => 'sds',
            'pdf_url' => 'dsd',
            'total_bayar' => 5000
        ];

        // $table->id();
        // $table->foreignId('meja_id');
        // $table->string('status');   //midtrans
        // $table->string('id_transaksi'); //midtrans
        // $table->string('tipe_pembayaran'); //midtran
        // $table->string('id_pemesanan'); //midtran
        // $table->string('kode_pembayaran')->nullable(); //midtrans
        // $table->string('pdf_url')->nullable();   //midtrans
        // $table->integer('total_bayar'); //midtrans
        // $table->timestamps();
    }
}
