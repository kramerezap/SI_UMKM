<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
       protected $table ='komentar';
    protected $fillable = [
        'ID_KOMENTAR','ID_PRODUK','ID_USER','KOMENTAR','TANGGAL','STATUSKM','STATUS_HAPUS'
    ];
   public $timestamps = false;

}
