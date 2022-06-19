<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin.pages.dashboard.index', [
            'current_date' => date('Y-m-d'),
        ]);
    }

    public function listOrder()
    {
        $Order =  DetailOrders::whereDate('created_at', date('Y-m-d'))->count();
        $transaksi = DetailOrders::select('total_bayar')->whereDate('created_at', date('Y-m-d'))->sum('total_bayar');

        $quary = "
        detail_orders.nota,
        detail_orders.id,
        detail_orders.nama,
        mejas.nama AS meja_id,
        sum(orders.qty) AS qty,
        status_pemesanan,
        status_pembayaran,
        tipe_pembayaran,
        detail_orders.created_at
        ";
        $detailOrder = DetailOrders::selectRaw($quary)
            ->join('orders', 'orders.detail_orders_id', '=', 'detail_orders.id')
            ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
            ->whereDate('detail_orders.created_at', date('Y-m-d'))
            ->groupBy('detail_orders.id')
            ->get();



        $detailOrder->map(function ($detailOrder) {
            // return [
            //     // 'id' => $detailOrder->id,
            //     // 'meja_id' => $detailOrder->meja_id,
            //     // 'status_pemesanan' => $detailOrder->status_pemesanan,
            //     // 'status_pembayaran' => $detailOrder->status_pembayaran,
            //     // 'tipe_pembayaran' => $detailOrder->tipe_pembayaran,
            //     // 'qty' => $detailOrder->qty,
            //     'created_at' => $detailOrder->created_at->diffForHumans(),
            // ];
            return  $detailOrder['timeForHumans'] =  $detailOrder->created_at->diffForHumans();
        });



        return response()->json([
            'listOrder' => $detailOrder,
            'jml_order' => $Order,
            'jml_transaksi' => "Rp " . number_format($transaksi, 0, ',', '.'),
        ]);
    }

    public function showModal($id)
    {
        $detailOrder = DetailOrders::select(['detail_orders.meja_id', 'detail_orders.id', 'status_pemesanan', 'menus.nama AS nama', 'kategori', 'qty'])
            ->join('orders', 'detail_orders.id', '=', 'orders.detail_orders_id')
            ->join('menus', 'orders.menu_id', '=', 'menus.id')
            ->where('detail_orders.id', $id)
            ->get();
        return $detailOrder;
    }

    public function updateOrder(Request $request)
    {
        DetailOrders::where('id', $request->id)->update(['status_pemesanan' => $request->status]);
    }

    public function salesToday()
    {
        // $Order =  DetailOrders::whereDate('created_at', date('Y-m-d'))->count();
        // $transaksi = DetailOrders::select('total_bayar')->whereDate('created_at', date('Y-m-d'))->sum('total_bayar');

        // return response()->json([
        //     ''
        // ]);
    }
}
