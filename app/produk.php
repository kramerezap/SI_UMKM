<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
       protected $table ='produk';
    protected $fillable = [
        'ID_PRODUK','NAMA_PRODUK','HARGA','FOTO','TGL_EXPIRED','KETERANGAN','STATUS_HAPUS'
    ];
   public $timestamps = false;

}
