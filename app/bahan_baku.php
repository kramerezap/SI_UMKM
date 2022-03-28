<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bahan_baku extends Model
{
       protected $table ='bahan_baku';
    protected $fillable = [
        'ID_BAHAN','NAMA_BAHAN','STOK_BAHAN'
    ];
   public $timestamps = false;

}
