<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
       protected $table ='cabang';
    protected $fillable = [
        'ID_CABANG','NAMA_CABANG','LOKASI'
    ];
   public $timestamps = false;

}
