<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class MenuPaymentController extends Controller
{
    public function index()
    {
        return view('cart', [
            'meja' => Session::get('meja')->nama
        ]);
    }

    public function payment(Request $request)
    {

        // $request

        // $json_name = json_decode($request->json_name, true);
        // dd($json_name);

        $json_menu = json_decode($request->json_menu, true);
        $gross_amount = end($json_menu)['gross_amount'];
        array_pop($json_menu);


        // dd($json_menu);
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
            "item_details" => $json_menu,
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
            ],
            'customer_details' => array(
                'first_name' => $request->json_name

            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('midtrans', [
            'snapToken' => $snapToken,
            'nameOrder' => $request->json_name
        ]);
    }

    public function payment_post(Request $request)
    {


        $menuJson = json_decode($request->menu_json, true);
        $midtransJson = json_decode($request->data_json, true);
        $meja_id = Session::get('meja')->id;
        DB::beginTransaction();
        try {

            $notaDB = DetailOrders::select('nota')->latest()->first();
            if ($notaDB == null) {
                $nota = 'SC' . date('m') . '-' . date('Y') . '0001' . date('d') . 'E';
            } elseif (substr($notaDB->nota, 2, 2) != date('m')) {
                $nota = 'SC' . date('m') . '-' . date('Y') . '0001' . date('d') . 'E';
            } else {
                $cut =  substr($notaDB->nota, 10, -3);
                $number = str_pad($cut + 1, 4, "0", STR_PAD_LEFT);;
                $nota = 'SC' . date('m') . '-' . date('Y') . $number . date('d') . 'E';
            }

            $detailOrder =  DetailOrders::create([
                'nota' => $nota,
                'nama' => $request->name_order_json,
                'meja_id' => $meja_id,
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
                    'meja_id' => $meja_id,
                    'qty' => $menu['quantity'],
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->to('/home/my-order');
    }
}
