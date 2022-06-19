<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use Illuminate\Http\Request;

class DashboardLaporanController extends Controller
{
    public function laporan()
    {

        if (request()->ajax()) {
            $select = [
                'mejas.nama as meja_id',
                'id_transaksi',
                'id_pemesanan',
                'status_pemesanan',
                'status_pembayaran',
                'tipe_pembayaran',
                'kode_pembayaran',
                'pdf_url',
                'uang_tunai',
                'kembalian',
                'total_bayar',
                'detail_orders.created_at'
            ];
            $data = DetailOrders::select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('kode_pembayaran', function (DetailOrders $detailOrders) {
                    if ($detailOrders->kode_pembayaran == null) {
                        return 'tidak ada';
                    }
                    return $detailOrders->kode_pembayaran;
                })
                ->editColumn('pdf_url', function (DetailOrders $detailOrders) {
                    if ($detailOrders->pdf_url == null) {
                        return 'tidak ada';
                    }
                    return $detailOrders->pdf_url;
                })
                ->editColumn('created_at', function (DetailOrders $detailOrders) {
                    return $detailOrders->created_at->format('Y-m-d');
                })
                ->editColumn('total_bayar', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->total_bayar, 0, ',', '.');
                })
                ->editColumn('kembalian', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->kembalian, 0, ',', '.');
                })
                ->editColumn('uang_tunai', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->uang_tunai, 0, ',', '.');
                })
                ->make(true);
        }

        return view('admin.pages.laporan.laporan');
    }


    public function laporan_eMoney()
    {
        if (request()->ajax()) {
            $select = [
                'mejas.nama as meja_id',
                'id_transaksi',
                'id_pemesanan',
                'status_pemesanan',
                'status_pembayaran',
                'tipe_pembayaran',
                'kode_pembayaran',
                'pdf_url',
                'total_bayar',
                'detail_orders.created_at'
            ];
            $data = DetailOrders::select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->whereNot('tipe_pembayaran', 'cash')->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('kode_pembayaran', function (DetailOrders $detailOrders) {
                    if ($detailOrders->kode_pembayaran == null) {
                        return 'tidak ada';
                    }
                    return $detailOrders->kode_pembayaran;
                })
                ->editColumn('pdf_url', function (DetailOrders $detailOrders) {
                    if ($detailOrders->pdf_url == null) {
                        return 'tidak ada';
                    }
                    return $detailOrders->pdf_url;
                })
                ->editColumn('created_at', function (DetailOrders $detailOrders) {
                    return $detailOrders->created_at->format('Y-m-d');
                })
                ->editColumn('total_bayar', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->total_bayar, 0, ',', '.');
                })
                ->make(true);
        }

        return view('admin.pages.laporan.laporan_eMoney');
    }

    public function laporan_cash()
    {
        if (request()->ajax()) {
            $select = [
                'mejas.nama as meja_id',
                'status_pemesanan',
                'status_pembayaran',
                'tipe_pembayaran',
                'total_bayar',
                'uang_tunai',
                'kembalian',
                'detail_orders.created_at'
            ];

            $data = DetailOrders::select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->where('tipe_pembayaran', 'cash')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('kembalian', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->kembalian, 0, ',', '.');
                })
                ->editColumn('uang_tunai', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->uang_tunai, 0, ',', '.');
                })
                ->editColumn('total_bayar', function (DetailOrders $detailOrders) {
                    return "Rp " . number_format($detailOrders->total_bayar, 0, ',', '.');
                })
                ->editColumn('created_at', function (DetailOrders $detailOrders) {
                    return $detailOrders->created_at->format('Y-m-d H:i:s');
                })
                ->make(true);
        }

        return view('admin.pages.laporan.laporan_cash');
    }

    public function grafik_penjualan()
    {


        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            $arr[] = DetailOrders::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
        }
        return view('admin.pages.laporan.grafik_penjualan', [
            'jml' => $arr
        ]);
    }

    public function list_grafik_penjualan($year)
    {
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            $arr[] = DetailOrders::whereMonth('created_at', $i)->whereYear('created_at', $year)->count();
        }
        return $arr;
    }
}
