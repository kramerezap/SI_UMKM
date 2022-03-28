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
use file;

class LoginController extends Controller
{
     public function login(){

        $data = DB::SELECT("SELECT * from user");
    
    	return view('login',['data'=>$data]);
    }
    public function register(){
    
        return view('register');
    }
    
    public function registerpm(){
    
        return view('registerpm');
    }

    public function loginaction(Request $request){
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        
        Session::flush();
        $data = DB::table('user')->where([['USERNAME',$USERNAME],['PASSWORD',$PASSWORD]])->get();
        foreach ($data as $key) {
            $USERNAME = $key->USERNAME;
            $LEVEL = $key->LEVEL;
            $STATUS = $key->STATUS;
        };

        if (count($data) == 0){
            return redirect('/')->with('gagal','.');
        }

        if($STATUS == 1){
             if($LEVEL == 1 ) {
                   $na = DB::SELECT("select * from USER where USERNAME like '$USERNAME'");
                   foreach ($na as $nam) {
                        Session::put('ID_USER',$nam->ID_USER);
                        Session::put('USERNAME',$USERNAME);
                        Session::put('PASSWORD',$PASSWORD);
                        Session::put('NAMA',$nam->NAMA);
                        Session::put('ALAMAT',$nam->ALAMAT);
                        Session::put('NO_TELP',$nam->NO_TELP);
                        Session::put('EMAIL',$nam->EMAIL);
                        Session::put('FOTO',$nam->FOTO);
                                 }

                        return redirect('/dashboardpemilik')->with('berhasil','.');
                             }
                else if($LEVEL == 2) {
                    $na = DB::SELECT("select * from USER where USERNAME like '$USERNAME'");
                    foreach ($na as $nam) {
                        Session::put('ID_USER',$nam->ID_USER);
                        Session::put('ID_CABANG',$nam->ID_CABANG);
                        Session::put('USERNAME',$USERNAME);
                        Session::put('PASSWORD',$PASSWORD);
                        Session::put('NAMA',$nam->NAMA);
                        Session::put('ALAMAT',$nam->ALAMAT);
                        Session::put('NO_TELP',$nam->NO_TELP);
                        Session::put('EMAIL',$nam->EMAIL);
                        Session::put('FOTO',$nam->FOTO);
                    }

                    return redirect('/dashboardadmin')->with('berhasil','.');
                }else if($LEVEL == 3) {
                    $na = DB::SELECT("select * from USER where USERNAME like '$USERNAME'");
                    foreach ($na as $nam) {
                        Session::put('ID_USER',$nam->ID_USER);
                        Session::put('ID_CABANG',$nam->ID_CABANG);
                        Session::put('USERNAME',$USERNAME);
                        Session::put('PASSWORD',$PASSWORD);
                        Session::put('NAMA',$nam->NAMA);
                        Session::put('ALAMAT',$nam->ALAMAT);
                        Session::put('NO_TELP',$nam->NO_TELP);
                        Session::put('EMAIL',$nam->EMAIL);
                        Session::put('FOTO',$nam->FOTO);
                    }

                    return redirect('/dashboardpelanggan')->with('berhasil','.');
                }
        }
        else{
            return redirect('/')->with('nonaktif','.');
        }
        
      
    }
    public function registeraction(Request $request)
    {
       
        
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        $FOTO = "defaultprofile.jpg";
        $LEVEL = $request->LEVEL;
        $STATUS = 0;
        $STATUS_HAPUS = 1;

        $data = new user();
        
       
        $data->USERNAME = $USERNAME;
        $data->PASSWORD = $PASSWORD;
        $data->NAMA = $NAMA;
        $data->ALAMAT= $ALAMAT;
        $data->NO_TELP = $NO_TELP;
        $data->EMAIL = $EMAIL;
        $data->FOTO = $FOTO;
        $data->LEVEL = $LEVEL;
        $data->STATUS = $STATUS;
        $data->STATUS_HAPUS = $STATUS_HAPUS;

        
        $data->save();
        
         
        return redirect('/');
    } 
    public function registerpmaction(Request $request)
    {  
        
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        $FOTO = "defaultprofile.jpg";
        $LEVEL = 1;
        $STATUS = 1;


        $data = new user();
        
       
        $data->USERNAME = $USERNAME;
        $data->PASSWORD = $PASSWORD;
        $data->NAMA = $NAMA;
        $data->ALAMAT= $ALAMAT;
        $data->NO_TELP = $NO_TELP;
        $data->EMAIL = $EMAIL;
        $data->FOTO = $FOTO;
        $data->LEVEL = $LEVEL;
        $data->STATUS = $STATUS;

        
        $data->save();
        
         
        return redirect('/');
    } 
}
