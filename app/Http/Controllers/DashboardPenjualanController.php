<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPenjualanController extends Controller
{

    public function index()
    {
        return view('admin.pages.penjualan.index', [
            'all_menu' => Menu::latest()->get(),
        ]);
    }

    public function get_penjualan()
    {
        return Menu::latest()->get();
    }

    public function store(Request $request)
    {
        $cart = json_decode($request->cart, true);
        $total = json_decode($request->total, true);
        $kembalian = json_decode($request->kembalian, true);

        DB::beginTransaction();
        try {
            $detailOrder =  DetailOrders::create([
                'meja_id' => 1,
                'status_pemesanan' => 'order',
                'status_pembayaran' => 'cash',
                'id_transaksi' => 0,
                'tipe_pembayaran' => 'cash',
                'id_pemesanan' => 0,
                'kode_pembayaran' =>  null,
                'pdf_url' =>   null,
                'total_bayar' => $total['totalBayar'],
                'uang_tunai' => $kembalian['uangTunai'],
                'kembalian' => $kembalian['kembalian'],
            ]);

            foreach ($cart as $menu) {
                Order::create([
                    'detail_orders_id' => $detailOrder->id,
                    'menu_id' => $menu['id'],
                    'meja_id' => 1,
                    'qty' => $menu['qty'],
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return redirect()->to('/admin/penjualan');
    }

    public function get_category($category)
    {
        if ($category == 'all') {
            return Menu::all();
        }
        return Menu::where('kategori', $category)->get();
    }
}
