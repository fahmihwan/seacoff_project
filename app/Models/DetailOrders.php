<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrders extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['order'];

    // public function order()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function laporanDate($select, $date, $tipe_pembayaran)
    {

        if ($tipe_pembayaran == 'cash') {
            return $this->select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->where('tipe_pembayaran', 'cash')
                ->whereDate('detail_orders.created_at', $date)
                ->get();
        }
        if ($tipe_pembayaran == 'e-money') {
            return $this->select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->whereNot('tipe_pembayaran', 'cash')
                ->whereDate('detail_orders.created_at', $date)
                ->get();
        }

        if ($tipe_pembayaran == 'all') {
            return  $this->select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->whereDate('detail_orders.created_at', $date)
                ->get();
        }
    }

    public function laporanMonth($select, $date, $tipe_pembayaran)
    {

        if ($tipe_pembayaran == 'cash') {
            return $this->select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->where('tipe_pembayaran', 'cash')
                ->whereYear('detail_orders.created_at', '=', $date[0])
                ->whereMonth('detail_orders.created_at', '=', $date[1])
                ->get();
        }
        if ($tipe_pembayaran == 'e-money') {
            return $this->select($select)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->whereNot('tipe_pembayaran', 'cash')
                ->whereYear('detail_orders.created_at', '=', $date[0])
                ->whereMonth('detail_orders.created_at', '=', $date[1])
                ->get();
        }

        if ($tipe_pembayaran == 'all') {
            return  $this->select($select, $date)
                ->join('mejas', 'detail_orders.meja_id', '=', 'mejas.id')
                ->whereYear('detail_orders.created_at', '=', $date[0])
                ->whereMonth('detail_orders.created_at', '=', $date[1])
                ->get();
        }
    }
}
