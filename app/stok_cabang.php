<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stok_cabang extends Model
{
       protected $table ='stok_cabang';
    protected $fillable = [
        'ID_STOK','ID_CABANG','ID_PRODUK','JUMLAH'
    ];
   public $timestamps = false;

}
