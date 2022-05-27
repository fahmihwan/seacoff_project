<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
use Egulias\EmailValidator\Result\Reason\UnclosedComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {


        return view('admin.pages.dashboard.index');
    }

    public function listOrder()
    {


        $detailOrder =  DetailOrders::whereDate('created_at', date('Y-m-d'))
            ->orderByDesc('created_at')
            ->get();;

        $multipled = $detailOrder->map(function ($detailOrder) {
            return [
                'id' => $detailOrder->id,
                'meja_id' => $detailOrder->meja_id,
                'id_transaksi' => $detailOrder->id_transaksi,
                'id_pemesanan' => $detailOrder->id_pemesanan,
                'status_pemesanan' => $detailOrder->status_pemesanan,
                'status_pembayaran' => $detailOrder->status_pembayaran,
                'tipe_pembayaran' => $detailOrder->tipe_pembayaran,
                'kode_pembayaran' => $detailOrder->kode_pembayaran,
                'pdf_url' => $detailOrder->pdf_url,
                'total_bayar' => $detailOrder->total_bayar,
                'created_at' => $detailOrder->created_at->diffForHumans(),
                'updated_at' => $detailOrder->updated_at,
            ];
        });
        return $multipled;
    }

    public function showModal($id)
    {

        $detailOrder = DetailOrders::select(['detail_orders.meja_id', 'detail_orders.id', 'status_pemesanan', 'nama', 'kategori', 'qty'])
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
}
