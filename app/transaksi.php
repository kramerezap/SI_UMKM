<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
       protected $table ='transaksi';
    protected $fillable = [
        'ID_TRANSAKSI','ID_USER','NO_NOTA','NAMA_PEMESAN','TGL_PESAN','TOTAL','BAYAR','KEMBALI','TGL_PENGIRIMAN','TUJUAN_PENGIRIMAN','BUKTI_PEMBAYARAN','STATUS_PENGIRIMAN'
    ];
   public $timestamps = false;

}
