@extends('pemilik/base')
@section('extrastyle')
<?php
$ambilpro = DB::SELECT("select * from produk where STATUS_HAPUS='1'");
?>
@endsection
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="/dashboardpemilik" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
            <li>
              <a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-code"></i> <span>Validasi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages1" class="collapse ">
                <ul class="nav">
                  <!-- <li><a href="page-profile.html" class="">Pemesanan</a></li>
                  --> <li><a href="/validasiadmin" class="">Admin</a></li>
                  <li><a href="/cabang" class="">Cabang</a></li>
                  <li><a href="/valpelanggan" class="">Pelanggan</a></li>
                </ul>
              </div>
            </li>
            <!-- <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Jadwal Produksi</span></a></li>
            --> <li>
              <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Daftar</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages2" class="collapse ">
                <ul class="nav">
                 <!--  <li><a href="/bahanbakupemilik" class="">Bahan</a></li>
                  --> <li><a href="/cekproduk" class="">Produk</a></li>
                  <li><a href="/tambahstokcabang" class="">Stok</a></li>
                      <li><a href="/produkcabang" class="">Produk Per Cabang</a></li>
                  
                </ul>
              </div>
            </li>
            <li>
              <a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages3" class="collapse ">
                <ul class="nav">
                  <li><a href="/jadwalpengirimanpm" class="">Jadwal Pengiriman</a></li>
                  <li><a href="/laporan" class="">Laporan</a></li>
                  <li><a href="/komentarpm" class="">Komentar</a></li>
                  
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
@endsection

@section('content')
<div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
    <div class="row">
            <div class="col-md-11">

              <!-- BORDERED TABLE -->
              <div class="panel" style="">
                <div class="panel-heading" >
                  <h3 class="panel-title">Data Produk</h3>
                </div>
                <button type="button" class="btn btn-primary" style="margin-left: 25px" data-toggle="modal" data-target="#modal-tambah">Tambah</button> 
                <div class="panel-body">
                  <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        
                        <th>Foto</th>
                        <th>Etc.</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $no = 1;

                      @endphp
                      @foreach($ambilpro as $data)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->NAMA_PRODUK}}</td>
                        <td><?php echo "Rp. ".number_format($data->HARGA)." ,-"; ?></td>
                        
                        <td><center><img src="Assets1/images/FOTO_PRODUK/{{$data->FOTO}}" width="75" height="65" alt="User"></center></td>
                        <td> 
                          <a  href="/editproduk={{$data->ID_PRODUK}}" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit{{$data->ID_PRODUK}}">
                          <span class="lnr lnr-pencil"></span></a>
                          <a href="/pemilik:hapusproduk={{$data->ID_PRODUK}}"  class="btn btn-danger btn-xs"  onclick="return(confirm('Anda Yakin Menghapus?? '));"><span class="lnr lnr-trash"></span></a>
                        </td>
                      </tr>
                      
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END BORDERED TABLE -->
            </div></div></div></div></div>
          </div>

          

<div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Input</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/tambahproduk" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
             

                  </div>

                  
                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama Produk :</label>
                         <input type="text" class="form-control" id="NAMA_PRODUK" name="NAMA_PRODUK" placeholder="" required="true">
               
                  </div>


                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Harga :</label>
                         <input type="number" class="form-control" id="HARGA" name="HARGA" placeholder="" required="true">
               
                  </div>
                  
                  
                   
                           <div class="form-group">
                     <label class="col-sm-2 col-sm-2 control-label">Foto :</label>
                     <div class="col-sm-8">
                      <input type="file" class="form-control" name="FOTO">
                        </div>
                                          
                    <br><br>


                </div>      

                </div>
                <!-- /.card-body -->

                <div class="modal-footer justify-content-between">
             <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              {{csrf_field()}}
            </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>   

@php 
      $dat = DB::table('produk')->get();
      @endphp
      @foreach($dat as $data)  
      <div class="modal fade" id="modal-edit{{$data->ID_PRODUK}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/editproduk={{$data->ID_PRODUK}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
               
                  </div>

                  
                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama Produk :</label>
                         <input type="text" class="form-control" id="NAMA_PRODUK" name="NAMA_PRODUK" placeholder="Nama Produk" value="{{$data->NAMA_PRODUK}}" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Harga :</label>
                         <input type="text" class="form-control" id="HARGA" name="HARGA" placeholder="Harga" value="{{$data->HARGA}}" required="true">
               
                  </div>
                 
                 
                                          
                    <div class="form-group">
                     <label class="col-sm-2 col-sm-2 control-label">Foto :</label>
                     <div class="col-sm-8">
                      <input type="file" class="form-control" name="FOTO">
                        </div>
                                          
                    <br><br>


                </div>


                </div>
                <!-- /.card-body -->

                <div class="modal-footer justify-content-between">
             <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              {{csrf_field()}}
            </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
      @endforeach  
@endsection