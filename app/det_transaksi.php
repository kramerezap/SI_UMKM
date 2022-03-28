<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class det_transaksi extends Model
{
       protected $table ='det_transaksi';
    protected $fillable = [
        'ID_DETAIL','ID_PRODUK','NO_NOTA','JUMLAH','TOTAL_HARGA','STATUS'
    ];
   public $timestamps = false;

}
