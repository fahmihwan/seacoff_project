<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use App\Models\Event;
use App\Models\Meja;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function event()
    {
        $events = Event::all();
        return view('event', [
            'events' => $events
        ]);
    }

    public function myorder()
    {
        if (Session::has('token')) {
            $meja = Meja::where('qrcode', Session::get('token'));
            if ($meja->count() != 0) {
                $data = $meja->select(['id', 'qrcode', 'nama'])->first();
                $status = 1;
            }
        } else {
            $data = 'silahkan scan QRcode di meja anda';
            $status = 0;
        }

        return view('myorder', [
            'status' => $status,
            'data' => $data
        ]);
    }

    public function list_notification()
    {

        if (Session::has('token')) {

            $meja = Meja::where('qrcode', Session::get('token'));
            if ($meja->count() != 0) {
                $select = [
                    'detail_orders.nama AS nama_pemesan',
                    'detail_orders.status_pembayaran',
                    'total_bayar',
                    'mejas.nama AS meja',
                    'nota',
                    'menus.nama AS nama',
                    'harga',
                    'detail_orders.created_at AS created_at',
                    'kategori',
                    'status_pemesanan',
                    'gambar',
                    'qty',
                ];
                $detailOrder = DetailOrders::select($select)
                    ->join('orders', 'orders.detail_orders_id', '=', 'detail_orders.id')
                    ->join('mejas', 'mejas.id', '=', 'detail_orders.meja_id')
                    ->join('menus', 'menus.id', '=', 'orders.menu_id')
                    ->where('mejas.qrcode', '=', $meja->first()->qrcode)
                    ->whereDate('detail_orders.created_at', date('Y-m-d'))
                    ->where('detail_orders.created_at', '>', Carbon::now()->subMinutes(40)->toDateTimeString())
                    ->get();


                $detailOrder->map(function ($detailOrder) {
                    return $detailOrder['timeForHumans'] = $detailOrder->created_at->diffForHumans();
                });


                $totalQty = 0;
                foreach ($detailOrder as $d) {
                    $totalQty += $d->qty;
                }

                return response()->json([
                    'listOrder' => $detailOrder,
                    'totalQty' => $totalQty
                ]);

                // return $detailOrder;
                // return view('myorder', [
                //     'status' => 1,
                //     'data' => $meja->first(),
                //     'orders' => $detailOrder
                // ]);

            }
        } else {
            abort(404);
        }
    }

    public function qrcode()
    {
        return view('scanQr');
    }

    public function scan(Request $request)
    {
        Session::put('token', $request->qrcode);
        return redirect()->to('/menu');
    }

    public function pindah_meja(Request $request)
    {
        // dd($request->qrcode);
        if ($request->qrcode && Session::has('token')) {
            Session::forget('token');
            Session::flush();
            return redirect()->to('/home/my-order');
        }
        return redirect()->to('/home/my-order');
    }
}
