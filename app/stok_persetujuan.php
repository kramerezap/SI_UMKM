<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stok_persetujuan extends Model
{
       protected $table ='stok_persetujuan';
    protected $fillable = [
        'ID_STOK','ID_CABANG','ID_PRODUK','JUMLAH'
    ];
   public $timestamps = false;

}
