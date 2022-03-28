<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\user;
use App\transaksi;
use App\kategori;
use App\bahan_baku;
use App\cabang;
use App\produk;
use App\komentar;
use App\stok_cabang;
use App\stok_persetujuan;
use App\det_transaksi;
use Carbon\Carbon;
use PDF;
use File;


class FeController extends Controller
{
    public function index(){
       $tmenu = DB::SELECT("select * from produk where STATUS_HAPUS='1'");
     return view('fe/index',['tmenu'=>$tmenu]);
             
    }
    public function komen($id){

    	$data = DB::SELECT("SELECT * FROM PRODUK where ID_PRODUK='$id'");
    	$tkom = DB::SELECT("SELECT * FROM KOMENTAR a, user b where a.ID_PRODUK='$id' and a.ID_USER=b.ID_USER");
    	$jkom = DB::SELECT("SELECT COUNT(*) as jumkom FROM KOMENTAR where ID_PRODUK='$id'");

     return view('fe/komen',['data'=>$data,'tkom'=>$tkom,'jkom'=>$jkom]);
             
    }
    public function postkomen(Request $request){

    	$USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $KOMENTAR = $request->KOMENTAR;
        $idp = $request->idp;
        $tgl = date('Y-m-d H-i-s');
        
        $dtvalid = DB::SELECT("select*from user where USERNAME = '$USERNAME' and PASSWORD = '$PASSWORD'");


        if(COUNT($dtvalid) == 0){

        	$data = DB::SELECT("SELECT * FROM PRODUK where ID_PRODUK='$idp'");
        	$tkom = DB::SELECT("SELECT * FROM KOMENTAR a, user b where a.ID_PRODUK='$idp' and a.ID_USER=b.ID_USER");
    		$jkom = DB::SELECT("SELECT COUNT(*) as jumkom FROM KOMENTAR where ID_PRODUK='$idp'");

		   	return view('/fe/komen',['data'=>$data,'tkom'=>$tkom,'jkom'=>$jkom])->with('gagal','.');

    	}else{

        	foreach($dtvalid as $key){
        	$idd = $key->ID_USER;	

        
        	$data = new komentar();

        	 	$data->ID_USER = $idd;
        	 	$data->ID_PRODUK = $idp;
		        $data->KOMENTAR = $KOMENTAR;
		        $data->TANGGAL = $tgl;

		        $data->save();
		        return redirect()->back()->with('barhasil','.');
		    }
        }
             
    }
}
