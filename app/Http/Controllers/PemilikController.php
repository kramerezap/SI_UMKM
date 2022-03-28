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

class PemilikController extends Controller
{
    public function persetujuan(Request $request,$id)
    {
        $ID_CABANG = $request->ID_CABANG;
        $ID_PRODUK = $request->ID_PRODUK;
        $JUMLAH = $request->JUMLAH;
        $TGL_EXPIRED = $request->TGL_EXPIRED;
        $KETERANGAN = $request->KETERANGAN;
        $STATUS_HAPUS = '1';

        $cek = DB::SELECT("select * from stok_cabang where ID_CABANG='$ID_CABANG' and ID_PRODUK='$ID_PRODUK' and STATUS_HAPUS='1'");
         if($cek != null ){

            foreach($cek as $sto){
                $sk = $sto->JUMLAH;

                $hst = $sk + $JUMLAH;
            }

            $data = DB::table('stok_cabang')->where('ID_CABANG',$ID_CABANG)->where('ID_PRODUK',$ID_PRODUK)->update(['JUMLAH'=> $hst]);

        }else{

         $data = new stok_cabang();
        
        $data->ID_CABANG = $ID_CABANG;
        $data->ID_PRODUK = $ID_PRODUK;
        $data->JUMLAH = $JUMLAH;
        $data->TGL_EXPIRED = $TGL_EXPIRED;
        $data->KETERANGAN = $KETERANGAN;
        $data->STATUS_HAPUS = $STATUS_HAPUS;
        $data->save();
        }

        DB::table('stok_persetujuan')->where('ID_STOKK',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect()->back();
    }

     public function tambahstokcabang(){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
            $cek = DB::SELECT("select * from stok_persetujuan a, produk b, cabang c where a.ID_PRODUK = b.ID_PRODUK and a.ID_CABANG = c.ID_CABANG and a.STATUS_HAPUS='1'");

        return view('pemilik/tambahstokcabang',['cek'=>$cek]);
            }
    }


    public function jadwalpengirimanpm(Request $request){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
            $jadwal = DB::SELECT("select *from transaksi a, user b where a.ID_USER=b.ID_USER and a.BAYAR IS NOT NULL");

        return view('pemilik/jadwalpengirimanpm',['jadwal'=>$jadwal]);
            }
    }

    public function komen1pm(Request $request,$id)
    {
        
        $data = DB::table('komentar')->where('ID_KOMENTAR',$id)->update(['STATUSKM'=>'0']);

        return redirect()->back()->with('addpeng','.');
    }
    public function komen0pm(Request $request,$id)
    {
        
        $data = DB::table('komentar')->where('ID_KOMENTAR',$id)->update(['STATUSKM'=>'1']);

        return redirect()->back()->with('addpeng','.');
    }

     public function komentarpm(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
            $tmenu = DB::SELECT("select * from produk where STATUS_HAPUS='1'");

        return view('pemilik/komentarpm',['tmenu'=>$tmenu]);
             }
    }
    public function edkomenpm($id){

        $data = DB::SELECT("SELECT * FROM PRODUK where ID_PRODUK='$id'");
        $tkom = DB::SELECT("SELECT * FROM KOMENTAR a, user b where a.ID_PRODUK='$id' and a.ID_USER=b.ID_USER and a.STATUS_HAPUS='1'");
       // $jkom = DB::SELECT("SELECT COUNT(*) as jumkom FROM KOMENTAR where ID_PRODUK='$id'");
        $dkom = DB::SELECT("SELECT * FROM KOMENTAR where ID_PRODUK='$id' and STATUS_HAPUS='1'");
     return view('pemilik/edkomenpm',['data'=>$data,'tkom'=>$tkom]);
             
    }
     public function hapuskomenpm($id)
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
            $chrt = DB::SELECT("SELECT NAMA_CABANG, COUNT(*) as jmlh FROM TRANSAKSI a, USER b, CABANG c where a.ID_USER=b.ID_USER and b.ID_CABANG = c.ID_CABANG GROUP BY c.ID_CABANG");
    	       return view('pemilik/dashboard',['chrt'=>$chrt]);
             }
    }
    public function profile(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
        return view('pemilik/profile');
             }
    }
    public function validasiadmin(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
    	return view('pemilik/validasiadmin');
             }
    }
    public function produkcabang(){
    if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
        return view('pemilik/produkcabang');
                }
    }
    public function cekproduk(){
    if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
        return view('pemilik/cekproduk');
                }
    }
   /* public function bahanbakupemilik(){
    if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
        return view('pemilik/bahanbaku');
        }
    }*/
    public function cabang(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
        return view('pemilik/cabang');
            }
    }

 public function valpelanggan(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
               return view('pemilik/pelanggan');
             }
    }

    public function laporan(Request $request){
         if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
               $cari = $request->cari;   
               if($cari == null){
           $trans = DB::SELECT("select *from transaksi a, user b, cabang c where a.ID_USER= b.ID_USER and b.ID_CABANG=c.ID_CABANG and a.BAYAR IS NOT NULL");
        }else{
       // $det = DB::SELECT("select *from det_transaksi where NO_NOTA = '$kode'");
      //  $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$id' and b.NO_NOTA = '$id' and a.ID_PRODUK = c.ID_PRODUK");
        
        $trans = DB::SELECT("select * from transaksi a, user b, cabang c where a.ID_USER=b.ID_USER and b.ID_CABANG=c.ID_CABANG and a.BAYAR IS NOT NULL and c.NAMA_CABANG like '%$cari%' ");

        }


        return view('/pemilik/laporan',['trans'=>$trans]);
        }
    }

    public function cetak_nota($id)
    {
        $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$id' and b.NO_NOTA = '$id' and a.ID_PRODUK = c.ID_PRODUK");
        $trans = DB::SELECT("select *from transaksi a, user b where NO_NOTA = '$id' and a.ID_USER = b.ID_USER");
        $tt = DB::SELECT("select *from transaksi where NO_NOTA = '$id'");
        $pdf = PDF::loadview('nota',['det'=>$det,'trans'=>$trans,'tt'=>$tt]);
        return $pdf->download('nota.pdf');


    }

 public function cetak_laporan()
    {
       
        $trans = DB::SELECT("select *from transaksi a, user b where a.ID_USER = b.ID_USER and a.BAYAR IS NOT NULL");
        $pdf = PDF::loadview('lapp',['trans'=>$trans]);
        return $pdf->download('Laporan.pdf');


    }



    public function tambahadmin(Request $request)
    {
        $ID_CABANG = $request->ID_CABANG;
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        $FOTO = $request->FOTO;
        $LEVEL = 2;
        $STATUS = 1;
        $STATUS_HAPUS = 1;

        $data = new user();
        
        $data->ID_CABANG = $ID_CABANG;
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

        if ($request->hasFile('FOTO')) {
             $request->file('FOTO')->move('Assets1/images/FOTO/',$request->file('FOTO')->getClientOriginalName());
             $data->FOTO = $request->file('FOTO')->getClientOriginalName();

        $data->save();
        }
        return redirect('/validasiadmin');
    } 

    public function editadmin(Request $request, $id)
    {
        $ID_CABANG = $request->ID_CABANG;
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        
        if($request->file('FOTO')==null){
       $data = DB::table('user')->where('ID_USER',$id)->update(['ID_CABANG'=>$ID_CABANG,'USERNAME'=>$USERNAME,'PASSWORD'=>$PASSWORD,'NAMA'=>$NAMA,'ALAMAT'=>$ALAMAT,'NO_TELP'=>$NO_TELP,'EMAIL'=>$EMAIL]);
       return redirect('/validasiadmin');
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


       

        $data = DB::table('user')->where('ID_USER',$id)->update(['ID_CABANG'=>$ID_CABANG,'USERNAME'=>$USERNAME,'PASSWORD'=>$PASSWORD,'NAMA'=>$NAMA,'ALAMAT'=>$ALAMAT,'NO_TELP'=>$NO_TELP,'EMAIL'=>$EMAIL,'FOTO'=>$m_path]);
        return redirect('/validasiadmin');
        }

    }


     public function hapusadmin($id)
    {
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
        DB::table('user')->where('ID_USER',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect('/validasiadmin');
    }
     public function ubahstatus1($id)
    {
        DB::table('user')->where('ID_USER',$id)->update(['STATUS' => 2]);
        return redirect('/validasiadmin');
    }
    public function ubahstatus2($id)
    {
        DB::table('user')->where('ID_USER',$id)->update(['STATUS' => 1]);
        return redirect('/validasiadmin');
    }



     public function tambahcabang(Request $request)
    {
        
        $NAMA_CABANG = $request->NAMA_CABANG;
        $LOKASI = $request->LOKASI;
        $STATUS_HAPUS = 1;

        $data = new cabang();
        
        $data->NAMA_CABANG = $NAMA_CABANG;
        $data->LOKASI = $LOKASI;
        $data->STATUS_HAPUS = $STATUS_HAPUS;
        $data->save();
        
        return redirect('/cabang');
    } 

    public function editcabang(Request $request, $id)
    {
        $NAMA_CABANG = $request->NAMA_CABANG;
        $LOKASI = $request->LOKASI;
        

        $data = DB::table('cabang')->where('ID_CABANG',$id)->update(['NAMA_CABANG'=>$NAMA_CABANG,'LOKASI'=>$LOKASI]);
        return redirect('/cabang');
        

    }
    
    public function hapuscabang($id)
    {
        DB::table('cabang')->where('ID_CABANG',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect('/cabang');
    }
     public function tambahbahanbaku(Request $request)
    {
        
        $NAMA_BAHAN = $request->NAMA_BAHAN;
        $STOK_BAHAN = $request->STOK_BAHAN;
       

        $data = new bahan_baku();
        
        $data->NAMA_BAHAN = $NAMA_BAHAN;
        $data->STOK_BAHAN = $STOK_BAHAN;
        $data->save();
        
        return redirect('/bahanbakupemilik');
    } 

    public function editbahan(Request $request, $id)
    {
        $NAMA_BAHAN = $request->NAMA_BAHAN;
        $STOK_BAHAN = $request->STOK_BAHAN;

        $data = DB::table('bahan_baku')->where('ID_BAHAN',$id)->update(['NAMA_BAHAN'=>$NAMA_BAHAN,'STOK_BAHAN'=>$STOK_BAHAN]);
        return redirect('/bahanbakupemilik');
        

    }

    public function hapusbahan($id)
    {
        DB::table('bahan_baku')->where('ID_BAHAN',$id)->delete();
        return redirect('/bahanbakupemilik');
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
       return redirect('/profilepemilik');
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
        return redirect('/profilepemilik');
        }

    }

    public function tambahpelanggan(Request $request)
    {
        $ID_CABANG = $request->ID_CABANG;
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        $FOTO = $request->FOTO;
        $LEVEL = 3;
        $STATUS = 1;
        $STATUS_HAPUS = 1;

        $data = new user();
        
        $data->ID_CABANG = $ID_CABANG;
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


        if ($request->hasFile('FOTO')) {
             $request->file('FOTO')->move('Assets1/images/FOTO/',$request->file('FOTO')->getClientOriginalName());
             $data->FOTO = $request->file('FOTO')->getClientOriginalName();

        $data->save();
        }
        return redirect('/valpelanggan');
    }

      public function hapuspelanggan($id)
    {
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

        DB::table('user')->where('ID_USER',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect('/valpelanggan');
    }
    public function ubahstatuspel1($id)
    {
        DB::table('user')->where('ID_USER',$id)->update(['STATUS' => 2]);
        return redirect('/valpelanggan');
    }
    public function ubahstatuspel2($id)
    {
        DB::table('user')->where('ID_USER',$id)->update(['STATUS' => 1]);
        return redirect('/valpelanggan');
    }


    public function editpelanggan(Request $request, $id)
    {
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        
        if($request->file('FOTO')==null){
       $data = DB::table('user')->where('ID_USER',$id)->update(['USERNAME'=>$USERNAME,'PASSWORD'=>$PASSWORD,'NAMA'=>$NAMA,'ALAMAT'=>$ALAMAT,'NO_TELP'=>$NO_TELP,'EMAIL'=>$EMAIL]);
       return redirect('/valpelanggan');
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
        return redirect('/valpelanggan');
        }

    }

 public function tambahproduk(Request $request)
    {
        
        $NAMA_PRODUK = $request->NAMA_PRODUK;
        $HARGA = $request->HARGA;
        $FOTO = $request->FOTO;
        
        $STATUS_HAPUS = 1;

        $data = new produk();
        
        $data->NAMA_PRODUK = $NAMA_PRODUK;
        $data->HARGA = $HARGA;
        $data->FOTO = $FOTO;
        
        $data->STATUS_HAPUS = $STATUS_HAPUS;
        if ($request->hasFile('FOTO')) {
             $request->file('FOTO')->move('Assets1/images/FOTO_PRODUK/',$request->file('FOTO')->getClientOriginalName());
             $data->FOTO = $request->file('FOTO')->getClientOriginalName();

        $data->save();
        }
       
        

       
        return redirect('/cekproduk');
    } 

    public function editproduk(Request $request, $id)
    {
        $NAMA_PRODUK = $request->NAMA_PRODUK;
        $HARGA = $request->HARGA;
        $FOTO = $request->FOTO;
        

        if($request->file('FOTO')==null){
       $data = DB::table('produk')->where('ID_PRODUK',$id)->update(['NAMA_PRODUK'=>$NAMA_PRODUK,'HARGA'=>$HARGA,'TGL_EXPIRED'=>$TGL_EXPIRED,'KETERANGAN'=>$KETERANGAN]);
        return redirect('/cekproduk');
                                        }
                    else{
                    $FOTO = DB::select("select*from user where ID_USER = '$id'");
                    foreach ($FOTO as $key) {
                       if($key->FOTO == 'defaultprofile.jpg'){

                        }else{
                        $image_path = "Assets1/images/FOTO_PRODUK/$key->FOTO";  
                             if(File::exists($image_path)) {
                                 File::delete($image_path);
                                }
                        }
                    }
                        

                        $photo_path=$request->file('FOTO');

                        $m_path=$photo_path->getClientOriginalName();
                        $photo_path->move('Assets1/images/FOTO_PRODUK/',$m_path);


       $data = DB::table('produk')->where('ID_PRODUK',$id)->update(['NAMA_PRODUK'=>$NAMA_PRODUK,'HARGA'=>$HARGA,'FOTO'=>$m_path]);
        return redirect('/cekproduk');

  }

        
        

    }
    
    public function hapusproduk($id)
    {
        
        DB::table('produk')->where('ID_PRODUK',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect('/cekproduk');
    }

}
