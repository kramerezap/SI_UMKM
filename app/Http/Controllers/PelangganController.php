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

class PelangganController extends Controller
{
    public function tmbhbukti(Request $request,$id)
    {
        
            
                    if($request->file('BUKTI')==null){
                           
                           return redirect('/pembayaran');
                      }
                    else{
                    $sql = DB::select("select*from transaksi where NO_NOTA = '$id'");
                    foreach ($sql as $key) {
                       if($key->BUKTI_PEMBAYARAN == 'defaultprofile.jpg'){

                        }else{
                        $image_path = "Assets1/images/BUKTI_PEMBAYARAN/$key->BUKTI_PEMBAYARAN";  
                             if(File::exists($image_path)) {
                                 File::delete($image_path);
                                }
                        }
                    }
                        

                        $photo_path=$request->file('BUKTI');

                        $m_path=$photo_path->getClientOriginalName();
                        $photo_path->move('Assets1/images/BUKTI_PEMBAYARAN/',$m_path);

        $data = DB::table('transaksi')->where('NO_NOTA',$id)->update(['BUKTI_PEMBAYARAN'=>$m_path]);
        return redirect('/pembayaran');
        }



              
    }

    public function pembayaran(Request $request){
         if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
            $sesser = Session::get("NAMA");  
       // $det = DB::SELECT("select *from det_transaksi where NO_NOTA = '$kode'");
      //  $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$id' and b.NO_NOTA = '$id' and a.ID_PRODUK = c.ID_PRODUK");
        $trans = DB::SELECT("select *, NAMA as adm from transaksi a, user b, cabang c where b.ID_CABANG=c.ID_CABANG and NAMA_PEMESAN = '$sesser' and a.ID_USER = b.ID_USER and a.BAYAR is NULL");
        


        return view('/pelanggan/pembayaran',['trans'=>$trans]);
        }
    }


     public function checkoutpsn(Request $request)
    {
        $NO_NOTA = $request->NO_NOTA;
        $ID_USER = $request->user;
        $JUM = $request->jum;
        $tgl = date('Y-m-d H-i-s');
        $ses = Session::GET('NAMA');
        $STATUS_PENGIRIMAN = 'Belum Terkirim';

        $data = new transaksi();
          

            $data->ID_USER = $ID_USER;
            $data->NO_NOTA = $NO_NOTA;
            $data->NAMA_PEMESAN = $ses;
            $data->TGL_PESAN = $tgl;
            $data->STATUS_PENGIRIMAN = $STATUS_PENGIRIMAN;
            $data->TOTAL = $JUM;
            
            $data->save();


        $data = DB::table('det_transaksi')->where('STATUS',3)->update(['STATUS'=>2]);
        

        return redirect('/cabpemesanan');

    }


    public function keranjang(){
        $ses = Session::GET('ID_USER');
        $cker = DB::SELECT("SELECT * FROM det_transaksi a, produk b, user c where a.STATUS='3' and a.ID_USER='$ses' and a.ID_PRODUK=b.ID_PRODUK and a.ID_USER=c.ID_USER");
        $cknot = DB::SELECT("SELECT * FROM det_transaksi a, produk b, user c where a.STATUS='3' and a.ID_USER='$ses' and a.ID_PRODUK=b.ID_PRODUK and a.ID_USER=c.ID_USER Group BY NO_NOTA");
    
     return view('pelanggan/keranjang',['cker'=>$cker,'cknot'=>$cknot]);
             
    }
     public function tmbhpesan(Request $request)
     {
        $ID_PRODUK = $request->PRODUK;
        $JUMLAH = $request->JUMLAH;
        $ID_USER = $request->IDU;
        $ID_CABANG = $request->ICAB;
        $NO_NOTA = $request->NO_NOTA;
        $STATUS = '3';
        $HARGA = $request->HRG;
        $TOTAL = $HARGA*$JUMLAH;
        $STOK = $request->ST;
        $SISA = $STOK-$JUMLAH;

        $data = new det_transaksi();
        
        $data->ID_PRODUK = $ID_PRODUK;
        $data->ID_USER = $ID_USER;
        $data->NO_NOTA = $NO_NOTA;
        $data->JUMLAH = $JUMLAH;
        $data->STATUS = $STATUS;
        $data->TOTAL_HARGA = $TOTAL;

       
        $data->save();

        $data2 = DB::table('stok_cabang')->where('ID_CABANG',$ID_CABANG)->where('ID_PRODUK',$ID_PRODUK)->update(['JUMLAH'=>$SISA]);
        
        return redirect()->back();
     }
     public function pemesanan($id){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
            $ses = Session::GET('ID_USER');
            $date = date('Y-m-d');
             $cid = DB::SELECT("select*from transaksi where DATE(TGL_PESAN) = '$date'");
             $idt = DB::SELECT("select*from transaksi where DATE(TGL_PESAN) = '$date' order by ID_TRANSAKSI DESC limit 1");
             $tmen = DB::SELECT("select * from stok_cabang a, produk b, cabang c where a.STATUS_HAPUS='1' and b.STATUS_HAPUS='1' and a.ID_PRODUK=b.ID_PRODUK and a.ID_CABANG=c.ID_CABANG and a.ID_CABANG='$id'");
             $cker = DB::SELECT("SELECT * FROM det_transaksi a, produk b, user c where a.STATUS='3' and a.ID_USER='$ses' and a.ID_PRODUK=b.ID_PRODUK and a.ID_USER=c.ID_USER");
             $cknot = DB::SELECT("SELECT * FROM det_transaksi a, produk b, user c where a.STATUS='3' and a.ID_USER='$ses' and a.ID_PRODUK=b.ID_PRODUK and a.ID_USER=c.ID_USER Group BY NO_NOTA");
             $namcab = DB::SELECT("select * from cabang where STATUS_HAPUS='1' and ID_CABANG='$id'");
             $inus = DB::SELECT("select * from user where ID_CABANG='$id'");
               return view('pelanggan/pemesanan',['tmen'=>$tmen,'cid'=>$cid,'idt'=>$idt,'cker'=>$cker,'cknot'=>$cknot,'namcab'=>$namcab,'inus'=>$inus]);
             }
    }

    public function cabpemesanan(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
          
             $tcab = DB::SELECT("select * from cabang where STATUS_HAPUS='1'");
               return view('pelanggan/cabpemesanan',['tcab'=>$tcab]);
             }
    }

     public function hapuskomenpl($id)
    {
        DB::table('komentar')->where('ID_KOMENTAR',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect()->back()->with('addpeng','.');
    }

     public function logout(){
        Session::flush();
        return redirect('/')->with('alert','Kamu sudah logout');
    }
    public function dashboard(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
             $tmenu = DB::SELECT("select * from produk where STATUS_HAPUS='1'");
    	       return view('pelanggan/dashboard',['tmenu'=>$tmenu]);
             }
    }
    public function edkomenpl($id){

        $data = DB::SELECT("SELECT * FROM PRODUK where ID_PRODUK='$id'");
        $tkom = DB::SELECT("SELECT * FROM KOMENTAR a, user b where a.ID_PRODUK='$id' and a.ID_USER=b.ID_USER and a.STATUS_HAPUS='1'");
        $jkom = DB::SELECT("SELECT COUNT(*) as jumkom FROM KOMENTAR where ID_PRODUK='$id' and STATUS_HAPUS='1'");

     return view('pelanggan/edkomenpl',['data'=>$data,'tkom'=>$tkom,'jkom'=>$jkom]);
             
    }
    public function postkomen(Request $request){

       
        $KOMENTAR = $request->KOMENTAR;
        $idp = $request->idp;
        $idses = $request->idses;
        $tgl = date('Y-m-d H-i-s');
        $STATUSKM = '1';
        $STATUS_HAPUS = '1';


            $data = new komentar();

                $data->ID_USER = $idses;
                $data->ID_PRODUK = $idp;
                $data->KOMENTAR = $KOMENTAR;
                $data->TANGGAL = $tgl;
                $data->STATUSKM = $STATUSKM;
                $data->STATUS_HAPUS = $STATUS_HAPUS;

                $data->save();
                return redirect()->back()->with('barhasil','.');
            
        
             
    }

    public function profile(){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
        return view('pelanggan/profile');
    }
    }

    public function editprofile(Request $request, $id)
    {
        
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        
        if($request->file('FOTO')==null){
       $data = DB::table('user')->where('ID_USER',$id)->update(['USERNAME'=>$USERNAME,'PASSWORD'=>$PASSWORD,'NAMA'=>$NAMA,'ALAMAT'=>$ALAMAT,'NO_TELP'=>$NO_TELP,'EMAIL'=>$EMAIL]);
       return redirect('/profilepelanggan');
                                        }


        else{
        $FOTO = DB::select("select*from user where ID_USER = '$id'");
        foreach ($FOTO as $key) {
            if($key->FOTO == 'defaultprofile.jpg'){

                        }else{
                        $image_path = "Assets1/images/FOTO/$key->FOTO";  
                             if(File::exists($image_path)) {
                                 File::delete($image_path);
                                }
                        }
        }

            $photo_path=$request->file('FOTO');

            $m_path=$photo_path->getClientOriginalName();
            $photo_path->move('Assets1/images/FOTO/',$m_path);


       

        $data = DB::table('user')->where('ID_USER',$id)->update(['USERNAME'=>$USERNAME,'PASSWORD'=>$PASSWORD,'NAMA'=>$NAMA,'ALAMAT'=>$ALAMAT,'NO_TELP'=>$NO_TELP,'EMAIL'=>$EMAIL,'FOTO'=>$m_path]);
        return redirect('/profilepelanggan');
        }

    }
     public function riwayatpemesanan(Request $request){
         if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
            $sesser = Session::get("NAMA");  
       // $det = DB::SELECT("select *from det_transaksi where NO_NOTA = '$kode'");
      //  $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$id' and b.NO_NOTA = '$id' and a.ID_PRODUK = c.ID_PRODUK");
        $trans = DB::SELECT("select *, NAMA as adm from transaksi a, user b  where NAMA_PEMESAN = '$sesser' and a.ID_USER = b.ID_USER and a.BAYAR IS NOT NULL ");
        


        return view('/pelanggan/riwayatpemesanan',['trans'=>$trans]);
        }
    }
    public function ratingkomen(Request $request)
    {
        $akun = $request->akun;
        $idtranss = $request->idtranss;
        $slider = $request->slider;
        $komen = $request->komen;
        $tgl = date('Y-m-d');
        

        $data = new komentar();
        
        $data->ID_USER = $akun;
        $data->ID_TRANSAKSI = $idtranss;
        $data->KOMENTAR = $komen;
        $data->PENILAIAN = $slider;
        $data->TANGGAL = $tgl;
        
       
        
        $data->save();
        
        return redirect('/lappemesanan');
    }

     public function editratingkomen(Request $request, $id)
    {
        
        $akun = $request->akun;
        $idtranss = $request->idtranss;
        $slider = $request->slider;
        $komen = $request->komen;
        $tgl = date('Y-m-d');
        
       

        $data = DB::table('komentar')->where('ID_KOMENTAR',$id)->update(['KOMENTAR'=>$komen,'PENILAIAN'=>$slider,'TANGGAL'=>$tgl]);
        return redirect('/lappemesanan');
        }

    

}
