<?php

namespace App\Http\Controllers;

use App\Models\DetailOrders;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{

    protected $model;
    public function __construct()
    {
        $this->model = new DetailOrders();
    }
    public function laporan_date(Request $request)
    {
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
        $detailOrders = $this->model->laporanDate($select, $request->date, 'all');
        $data = [
            'title' => 'Laporan Penjualan ',
            'date' => $request->date,
            'reports' => $detailOrders
        ];
        //


        // return view('admin.pages.printPdf.laporan', $data);
        $pdf = PDF::loadView('admin.pages.printPdf.laporan', $data);

        return $pdf->download('seacoff.pdf');
    }

    public function laporan_month(Request $request)
    {

        $date = explode('-', $request->month);
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

        $detailOrders = $this->model->laporanMonth($select, $date, 'all');
        $data = [
            'title' => 'Laporan Penjualan Bulanan ',
            'date' => $request->date,
            'reports' => $detailOrders
        ];

        $pdf = PDF::loadView('admin.pages.printPdf.laporan', $data);

        return $pdf->download('seacoff.pdf');
        // return view('admin.pages.printPdf.laporan', $data);
    }

    public function laporan_eMoney_date(Request $request)
    {
        $select = [
            'mejas.nama as meja_id',
            'id_transaksi',
            'id_pemesanan',
            'status_pemesanan',
            'status_pembayaran',
            'tipe_pembayaran',
            'kode_pembayaran',
            'pdf_url',
            // 'uang_tunai',
            // 'kembalian',
            'total_bayar',
            'detail_orders.created_at'
        ];

        $detailOrders = $this->model->laporanDate($select, $request->date, 'e-money');
        $data = [
            'title' => 'Laporan e-money ',
            'date' => $request->date,
            'reports' => $detailOrders
        ];

        return view('admin.pages.printPdf.laporan', $data);
    }
    public function laporan_eMoney_month(Request $request)
    {
        $date = explode('-', $request->month);
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

        $detailOrders = $this->model->laporanMonth($select, $date, 'e-money');
        $data = [
            'title' => 'Laporan e-money ',
            'date' => $request->date,
            'reports' => $detailOrders
        ];

        return view('admin.pages.printPdf.laporan', $data);
    }

    public function laporan_cash_date(Request $request)
    {
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

        $detailOrders = $this->model->laporanDate($select, $request->date, 'cash');
        $data = [
            'title' => 'Laporan e-money ',
            'date' => $request->date,
            'reports' => $detailOrders
        ];

        return view('admin.pages.printPdf.laporan', $data);
    }
    public function laporan_cash_month(Request $request)
    {
        $date = explode('-', $request->month);
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

        $detailOrders = $this->model->laporanMonth($select, $date, 'cash');
        $data = [
            'title' => 'Laporan e-money ',
            'date' => $request->date,
            'reports' => $detailOrders
        ];

        return view('admin.pages.printPdf.laporan', $data);
    }
}
