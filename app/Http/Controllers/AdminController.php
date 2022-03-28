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

class AdminController extends Controller
{
    public function tmbhbayar(Request $request,$id)
    {
        $BAYAR = $request->BAYAR;
        $KEMBALI = '0';
        
        $data = DB::table('transaksi')->where('NO_NOTA',$id)->update(['BAYAR'=>$BAYAR,'KEMBALI'=>$KEMBALI]);
        

        return redirect('/trpemesanan');

    }

    public function trpemesanan(Request $request){
         if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
            $sesser = Session::get("ID_USER");  
       // $det = DB::SELECT("select *from det_transaksi where NO_NOTA = '$kode'");
      //  $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$id' and b.NO_NOTA = '$id' and a.ID_PRODUK = c.ID_PRODUK");
        $tpem = DB::SELECT("select * from transaksi where ID_USER='$sesser' and BAYAR is NULL and BUKTI_PEMBAYARAN is NOT NULL");
        


        return view('/admin/trpemesanan',['tpem'=>$tpem]);
        }
    }

    public function komentaradm(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
            $tmenu = DB::SELECT("select * from produk where STATUS_HAPUS='1'");

        return view('admin/komentaradm',['tmenu'=>$tmenu]);
             }
    }
    public function edkomenadm($id){

        $data = DB::SELECT("SELECT * FROM PRODUK where ID_PRODUK='$id'");
         $tkom = DB::SELECT("SELECT * FROM KOMENTAR a, user b where a.ID_PRODUK='$id' and a.ID_USER=b.ID_USER and a.STATUS_HAPUS='1'");
       // $jkom = DB::SELECT("SELECT COUNT(*) as jumkom FROM KOMENTAR where ID_PRODUK='$id'");

     return view('admin/edkomenadm',['data'=>$data,'tkom'=>$tkom]);
             
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
               return view('admin/dashboard',['chrt'=>$chrt]);
    	
    }
    }
    public function profile(){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
        return view('admin/profile');
    }
    }
     public function transaksi(){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
             $stat = 1;
       
        $now = Carbon::now();
        $date = date('Y-m-d');
        $tagg = '2';
        //$idb = transaksi::getId();

        $cid = DB::SELECT("select*from transaksi where DATE(TGL_PESAN) = '$date'");
        $idt = DB::SELECT("select*from transaksi where DATE(TGL_PESAN) = '$date' order by ID_TRANSAKSI DESC limit 1");
        $data = DB::SELECT("select *from det_transaksi where STATUS = '1'");

        $pro = '0';
        $ses = Session::get('ID_CABANG');
        $produk = DB::SELECT("SELECT * FROM produk a, stok_cabang b where a.ID_PRODUK = b.ID_PRODUK and b.ID_CABANG = '$ses'");
      
        return view('admin/transaksi',['data'=>$data,'cid'=>$cid,'idt'=>$idt,'produk'=>$produk,'stat'=>$stat,'pro'=> $pro,'tagg'=> $tagg]);
        
    }
    }

    public function checkouttransaksi(Request $request)
    {
        $kode = $request->kode;
        $pelanggan = $request->pelanggan;
        $total = $request->total;
        $bayar = $request->bayar;
        $kembali = $request->kembali;
        $akun = $request->akun;
        $tgl = date('Y-m-d H-i-s');
        $status = 'Belum Terkirim';

        $data = new transaksi();
          
            $data->ID_USER = $akun;
            $data->NO_NOTA = $kode;
            $data->NAMA_PEMESAN = $pelanggan;
            $data->TGL_PESAN = $tgl;
            $data->TOTAL = $total;
            $data->BAYAR = $bayar;
            $data->KEMBALI = $kembali;
            $data->STATUS_PENGIRIMAN = $status;
            $data->save();


        $data = DB::table('det_transaksi')->where('STATUS',1)->update(['STATUS'=>2]);
        $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$kode' and b.NO_NOTA = '$kode' and a.ID_PRODUK = c.ID_PRODUK");
        $trans = DB::SELECT("select *from transaksi where NO_NOTA = '$kode'");




        return view('/admin/checkcetak',['det'=>$det,'trans'=>$trans,'kode'=>$kode,'total'=>$total,'bayar'=>$bayar,'kembali'=>$kembali]);

    }

 

    public function rekaplaporan(Request $request)
    {

    $sesser = Session::get('ID_USER');  

        $cari = $request->cari;       
       // $det = DB::SELECT("select *from det_transaksi where NO_NOTA = '$kode'");
        if($cari == null){
            $trans = DB::SELECT("select * from transaksi a, user b where a.ID_USER=b.ID_USER and a.ID_USER = '$sesser' and a.BAYAR IS NOT NULL");
        }else{
            
            $trans = DB::SELECT("select * from transaksi a, user b where a.ID_USER=b.ID_USER and a.ID_USER = '$sesser' and a.TGL_PESAN like '%$cari%' and a.BAYAR IS NOT NULL");

        }


        return view('/admin/rekaplaporan',['trans'=>$trans]);

    }

    public function produk(){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
            $ses = Session::get('ID_CABANG');
            $cek = DB::SELECT("select * from stok_cabang a, produk b where a.ID_PRODUK = b.ID_PRODUK and a.ID_CABANG = '$ses' and a.STATUS_HAPUS='1'");
    	return view('admin/produk',['cek'=>$cek]);
    }
    }
     public function jadwalpengiriman(Request $request){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{

           $sesi =  Session::get('ID_USER');
            $jadwal = DB::SELECT("select *from transaksi a, user b where a.ID_USER=b.ID_USER and a.ID_USER = '$sesi' and a.BAYAR IS NOT NULL");

        return view('admin/jadwalpengiriman',['jadwal'=>$jadwal]);
            }
    }

    public function bayar(Request $request){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{

        $kode = $request->kode;
        $total = $request->total;

        $napel = DB::SELECT("select *from user where LEVEL='3' and STATUS='1' and STATUS_HAPUS='1'");

        return view('admin/bayar',['kode'=>$kode,'total'=>$total,'napel'=>$napel]);
    }
    }
    /*public function bahanbaku(){
    if(Session::get('NAMA') == null) {
             return redirect('login')->with('seslog','.');
        }else{
        return view('admin/bahanbaku');
    }
    }*/
    public function valpelanggan(){
        if(Session::get('NAMA') == null) {
                return redirect('login')->with('seslog','.');
        }else{
               return view('admin/pelanggan');
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
       return redirect('/profileadmin');
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
        return redirect('/profileadmin');
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
        return redirect('/valpelangganadm');
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
        return redirect('/valpelangganadm');
    }
    public function ubahstatuspel1($id)
    {
        DB::table('user')->where('ID_USER',$id)->update(['STATUS' => 2]);
        return redirect('/valpelangganadm');
    }
    public function ubahstatuspel2($id)
    {
        DB::table('user')->where('ID_USER',$id)->update(['STATUS' => 1]);
        return redirect('/valpelangganadm');
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
       return redirect('/valpelangganadm');
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
        return redirect('/valpelangganadm');
        }

    }

    public function tambahstok(Request $request)
    {
        
        $ID_STOK = $request->ID_STOK;
        $ID_CABANG = $request->ID_CABANG;
        $ID_PRODUK = $request->ID_PRODUK;
        $JUMLAH = $request->JUMLAH;
        $TGL_EXPIRED = $request->TGL_EXPIRED;
        $KETERANGAN = $request->KETERANGAN;
        $STATUS_HAPUS = '1';

    

         $data = new stok_persetujuan();
        
        $data->ID_CABANG = $ID_CABANG;
        $data->ID_PRODUK = $ID_PRODUK;
        $data->JUMLAH = $JUMLAH;
        $data->TGL_EXPIRED = $TGL_EXPIRED;
        $data->KETERANGAN = $KETERANGAN;
        $data->STATUS_HAPUS = $STATUS_HAPUS;
        $data->save();
        

        return redirect('/produk');
    } 
     public function editexp(Request $request, $id)
    {
        
        $TGL_EXPIRED = $request->TGL_EXPIRED;
        $KETERANGAN = $request->KETERANGAN;
        

        $data = DB::table('stok_cabang')->where('ID_STOK',$id)->update(['TGL_EXPIRED'=>$TGL_EXPIRED,'KETERANGAN'=>$KETERANGAN]);
        return redirect('/produk');
        

    }
    public function hapusstok($id)
    {
        DB::table('stok_cabang')->where('ID_STOK',$id)->update(['STATUS_HAPUS'=>0]);
        return redirect('/produk');
    }


  public function search(Request $request)
    {
        $stat = '2';
        $tagg = '1';
        $now = Carbon::now();
        $date = date('Y-m-d');
       
        //$idb = transaksi::getId();

        $cid = DB::SELECT("select*from transaksi where DATE(TGL_PESAN) = '$date'");
        $idt = DB::SELECT("select*from transaksi where DATE(TGL_PESAN) = '$date' order by ID_TRANSAKSI DESC limit 1");
        $data = DB::SELECT("select *from det_transaksi where STATUS = '1'");

       
       
        
        $pro = $request->produk;
        

        $ses = Session::get('ID_CABANG');
         $produk = DB::SELECT("SELECT * FROM produk a, stok_cabang b where a.ID_PRODUK = b.ID_PRODUK and b.ID_CABANG = '$ses'");
      



            $harga = DB::SELECT("SELECT * FROM produk a, stok_cabang b where a.ID_PRODUK = b.ID_PRODUK and b.ID_CABANG = '$ses' and a.ID_PRODUK = '$pro'");

         return view('admin/transaksi',['idt'=>$idt,'data'=>$data,'cid'=>$cid,'produk'=>$produk,'stat'=>$stat,'harga'=>$harga,'pro'=> $pro,'tagg'=> $tagg]);
    }

    public function addcart(Request $request)
    {
        
        $NO_NOTA = $request->NO_NOTA;
        $ID_PRODUK = $request->ID_PRODUK;
       // $HARGA = $request->HARGA;
        $JUMLAH = $request->JUMLAH;
        $TOTAL_HARGA = $request->TOTAL_HARGA;
        $SESSION_CABANG = $request->SESSION_CABANG;
        $STOK = $request->ST;
        $SISA = $STOK-$JUMLAH;

       $data = new det_transaksi();
     
        $data->NO_NOTA = $NO_NOTA;
        $data->ID_PRODUK = $ID_PRODUK;
       // $data->HARGA = $HARGA;
        $data->JUMLAH = $JUMLAH;
        $data->TOTAL_HARGA = $TOTAL_HARGA;
        $data->STATUS = '1';
        $data->save();

         $data2 = DB::table('stok_cabang')->where('ID_CABANG',$SESSION_CABANG)->where('ID_PRODUK',$ID_PRODUK)->update(['JUMLAH'=>$SISA]);

        return redirect('transaksi');

    }
   public function hapuscart($id)
    {
        DB::table('det_transaksi')->where('ID_DETAIL',$id)->delete();
        return redirect('/transaksi');
    }



     public function cetak_pdf(Request $request)
    {
       $kode = $request->kode;

       $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$kode' and b.NO_NOTA = '$kode' and a.ID_PRODUK = c.ID_PRODUK");
        $trans = DB::SELECT("select *from transaksi a, user b where NO_NOTA = '$kode' and a.ID_USER = b.ID_USER");
        $tt = DB::SELECT("select *from transaksi where NO_NOTA = '$kode'");
        $pdf = PDF::loadview('nota',['det'=>$det,'trans'=>$trans,'tt'=>$tt]);
        return $pdf->download('nota.pdf');


    }

    public function cetak_nota($id)
    {

       $det = DB::SELECT("select *from det_transaksi a, transaksi b, produk c where a.NO_NOTA = '$id' and b.NO_NOTA = '$id' and a.ID_PRODUK = c.ID_PRODUK");
        $trans = DB::SELECT("select *from transaksi a, user b where NO_NOTA = '$id' and a.ID_USER = b.ID_USER");
        $tt = DB::SELECT("select *from transaksi where NO_NOTA = '$id'");
        $pdf = PDF::loadview('nota',['det'=>$det,'trans'=>$trans,'tt'=>$tt]);
        return $pdf->download('nota.pdf');


    }

   /* public function addpelanggan(Request $request)
    {

        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $ALAMAT = $request->ALAMAT;
        $NO_TELP = $request->NO_TELP;
        $EMAIL = $request->EMAIL;
        $FOTO = "defaultprofile.jpg";
        $LEVEL = 3;
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
        
        return redirect('dashboardadmin');
    }*/
     

    public function tambahpelanggantr(Request $request)
    {
        $kode = $request->kode;
        $total = $request->total;
        
        $USERNAME = $request->USERNAME;
        $PASSWORD = $request->PASSWORD;
        $NAMA = $request->NAMA;
        $FOTO = "defaultprofile.jpg";
        $LEVEL = 3;
        $STATUS = 1;
        $STATUS_HAPUS = 1;

        $data = new user();
        
       
        $data->USERNAME = $USERNAME;
        $data->PASSWORD = $PASSWORD;
        $data->NAMA = $NAMA;
        $data->FOTO = $FOTO;
        $data->LEVEL = $LEVEL;
        $data->STATUS = $STATUS;
        $data->STATUS_HAPUS = $STATUS_HAPUS;

        
        $data->save();
        
         $napel = DB::SELECT("select *from user where LEVEL='3' and STATUS='1' and STATUS_HAPUS='1'");

        return view('admin/bayar',['kode'=>$kode,'total'=>$total,'napel'=>$napel]);
    }

    public function updjdwl(Request $request, $id)
    {
        $TUJ = $request->TUJ;

        DB::table('transaksi')->where('ID_TRANSAKSI',$id)->update(['TGL_PENGIRIMAN'=> date('Y-m-d H-i-s'),'STATUS_PENGIRIMAN' => 'Sudah Terkirim', 'TUJUAN_PENGIRIMAN'=>$TUJ]);
        return redirect('/jadwalpengiriman');
    }
    public function cetak_laporan()
    {
       
       $sesser = Session::get("ID_USER");
        $trans = DB::SELECT("select *from transaksi a, user b where a.ID_USER = b.ID_USER and a.ID_USER='$sesser' and a.BAYAR IS NOT NULL");
        $pdf = PDF::loadview('lapp',['trans'=>$trans]);
        return $pdf->download('Laporan.pdf');


    }
}
