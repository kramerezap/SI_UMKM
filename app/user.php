<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
       protected $table ='user';
    protected $fillable = [
        'ID_USER','USERNAME','PASSWORD','NAMA','ALAMAT','NO_TELP','EMAIL','FOTO','LEVEL','STATUS'
    ];
   public $timestamps = false;

}
