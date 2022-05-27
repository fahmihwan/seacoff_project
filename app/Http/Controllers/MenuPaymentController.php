<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class MenuPaymentController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function payment(Request $request)
    {
        $json = json_decode($request->json, true);
        $gross_amount = end($json)['gross_amount'];
        array_pop($json);

        // dd($json);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $gross_amount,
            ),
            "item_details" => $json,
            "enabled_payments" => [
                "gopay",
                "shopeepay",
                "permata_va",
                "bca_va",
                "bni_va",
                "bri_va",
                "danamon_online",
                "mandiri_clickpay",
                "bca_klikbca",
                "bca_klikpay",
                "bri_epay",
                "akulaku"
            ]
            // 'customer_details' => array(
            //     'first_name' => 'budi',
            //     'last_name' => 'pratama',
            //     'email' => 'budi.pra@example.com',
            //     'phone' => '08111222333',
            // ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('midtrans', [
            'snapToken' => $snapToken
        ]);
    }

    public function payment_post(Request $request)
    {

        $menuJson = json_decode($request->menu_json, true);
        $midtransJson = json_decode($request->data_json, true);

        DB::beginTransaction();
        try {

            $detailOrder =  DetailOrders::create([
                'meja_id' => 1,
                'status_pemesanan' => 'order',
                'status_pembayaran' => $midtransJson['transaction_status'],
                'id_transaksi' => $midtransJson['transaction_id'],
                'tipe_pembayaran' => $midtransJson['payment_type'],
                'id_pemesanan' => $midtransJson['order_id'],
                'kode_pembayaran' => isset($midtransJson['payment_code']) ? $midtransJson['payment_code'] : null,
                'pdf_url' =>  isset($midtransJson['pdf_url']) ? $midtransJson['pdf_url'] : null,
                'total_bayar' => $midtransJson['gross_amount'],
            ]);

            foreach ($menuJson as $menu) {
                Order::create([
                    'detail_orders_id' => $detailOrder->id,
                    'menu_id' => $menu['id'],
                    'meja_id' => 1,
                    'qty' => $menu['quantity'],
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
