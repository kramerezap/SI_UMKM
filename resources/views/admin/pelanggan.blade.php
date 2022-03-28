@extends('admin/base')
@section('extrastyle')
<?php
$ambil = DB::SELECT("select * from user where LEVEL like '3' and STATUS_HAPUS='1'");

?>
@endsection
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="/dashboardadmin" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
            <li><a href="/valpelangganadm" class="active"><i class="lnr lnr-heart"></i> <span>Pelanggan</span></a></li>
            <li><a href="/produk" class=""><i class="lnr lnr-alarm"></i> <span>Produk</span></a></li>
            <li><a href="/transaksi" class=""><i class="lnr lnr-cart"></i> <span>Transaksi</span></a></li>
            <li><a href="/trpemesanan" class=""><i class="lnr lnr-book"></i> <span>Pemesanan</span></a></li>
           <li><a href="/jadwalpengiriman" class=""><i class="lnr lnr-calendar-full"></i> <span>Jadwal Pengiriman</span></a></li>
            
            <li>
              <a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages3" class="collapse ">
                <ul class="nav">
                  <li><a href="/rekaplaporan" class="">Cetak Laporan</a></li>
                  <li><a href="/komentaradm" class="">Komentar</a></li>
                  
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
@endsection

@section('content')


<div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Input</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/tambahpelangganadm" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
               
                  </div>
                   

                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Username :</label>
                         <input type="text" class="form-control" id="USERNAME" name="USERNAME" placeholder="Username" required="true">
               
                  </div>


                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Password :</label>
                         <input type="text" class="form-control" id="PASSWORD" name="PASSWORD" placeholder="Password" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama :</label>
                         <input type="text" class="form-control" id="NAMA" name="NAMA" placeholder="Nama" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Alamat :</label>
                         <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" placeholder="Alamat" required="true">
               
                  </div>
                  <div class="form-group">
             
                       <label class="col-sm-8 col-sm-8 control-label">No Telp :</label>
                         <input type="text" class="form-control" id="NO_TELP" name="NO_TELP" placeholder="No Telepon" required="true">
               
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Email :</label>
                         <input type="Email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Email" required="true">
               
                  </div>
                 
                  <div class="form-group">
                     <label class="col-sm-2 col-sm-2 control-label">Foto :</label>
                     <div class="col-sm-8">
                      <input type="file" class="form-control" name="FOTO">
                        </div>
                                          
                    <br><br>


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
      $dat = DB::table('user')->where('LEVEL',3)->get();
      
      @endphp
      @foreach($dat as $data)  
      <div class="modal fade" id="modal-edit{{$data->ID_USER}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/editpelangganadm={{$data->ID_USER}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
               
                  </div>

                 
                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Username :</label>
                         <input type="text" class="form-control" id="USERNAME" name="USERNAME" placeholder="Username" value="{{$data->USERNAME}}" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Password :</label>
                         <input type="text" class="form-control" id="PASSWORD" name="PASSWORD" placeholder="Password" value="{{$data->PASSWORD}}" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama :</label>
                         <input type="text" class="form-control" id="NAMA" name="NAMA" placeholder="Nama" value="{{$data->NAMA}}" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Alamat :</label>
                         <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" placeholder="Alamat" value="{{$data->ALAMAT}}" required="true">
               
                  </div>
                  <div class="form-group">
             
                       <label class="col-sm-8 col-sm-8 control-label">No Telp :</label>
                         <input type="text" class="form-control" id="NO_TELP" name="NO_TELP" placeholder="No Telepon" value="{{$data->NO_TELP}}" required="true">
               
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Email :</label>
                         <input type="Email" class="form-control" id="EMAIL" name="EMAIL" placeholder="Email" value="{{$data->EMAIL}}" required="true">
               
                  </div>
                 
                  <div class="form-group">
                     <label class="col-sm-2 col-sm-2 control-label">Foto :</label>
                     <div class="col-sm-8">
                      <input type="file" class="form-control" name="FOTO" value="Assets1/images/FOTO/{{$data->FOTO}}">
                        </div>
                                          
                    <br><br>


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


<div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
          <!-- OVERVIEW -->
    <div class="row">
            <div class="col-md-12">

              <!-- BORDERED TABLE -->
              <div class="panel">
                <div class="panel-heading" >
                  <h3 class="panel-title">Data Pelanggan</h3>
                </div>
                <button type="button" class="btn btn-primary" style="margin-left: 25px" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
                <div class="panel-body">
                  <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $no = 1;

                      @endphp
                      @foreach($ambil as $data)
                      <tr>
                        <td>{{$no++}}</td>
                       
                                
                        <td>{{$data->USERNAME}}</td>
                        <td>{{$data->PASSWORD}}</td>
                        <td>{{$data->NAMA}}</td>
                        <!-- <td>{{$data->ALAMAT}}</td>
                        <td>{{$data->NO_TELP}}</td>
                        <td>{{$data->EMAIL}}</td>
                        <td><img src="Assets1/images/FOTO/{{$data->FOTO}}" width="60" height="60" alt="User"></td>
                         -->
                         @if($data->STATUS==1)
                        <td><a href="/ubahstatuspel1adm={{$data->ID_USER}}" type="button" class="btn btn-success">Aktif</a></td>
                        @elseif($data->STATUS==2)
                        <td><a href="/ubahstatuspel2adm={{$data->ID_USER}}" type="button" class="btn btn-danger">NonAktif</a></td>
                        @elseif($data->STATUS==0)
                        <td><a href="/ubahstatuspel2adm={{$data->ID_USER}}" type="button" class="btn btn-warning">Belum Terdaftar</a></td>
                        @endif


                        <td> 
                          <a  href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-detail{{$data->ID_USER}}"><span class=" fa fa-info-circle"></span></a>
                          <a  href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit{{$data->ID_USER}}">
                          <span class="lnr lnr-pencil"></span></a>
                          <a href="/admin:hapuspelangganadm={{$data->ID_USER}}"  class="btn btn-danger btn-xs"  onclick="return(confirm('Anda Yakin Menghapus?? '));"><span class="lnr lnr-trash"></span></a>
                        </td>
                                             
                      </tr>
                      
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END BORDERED TABLE -->
            </div>
</div></div></div>


@php 
      $tab = DB::table('user')->get();
      
      @endphp
      @foreach($tab as $datadetail2)  
      
<div class="modal fade" id="modal-detail{{$datadetail2->ID_USER}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail</h4>
            </div>
            <div class="modal-body">
             
                 
                  @php 
                      $id=$datadetail2->ID_USER;
                      $datdet = DB::table('user')->where('ID_USER', $id)->get();
                  @endphp
      @foreach($datdet as $datadetail)  
               <table >
                      <tr>
                        <!-- <td>Foto</td>
                        <td style="padding-left: 5px">:</td> -->
                        <td style=""><img src="Assets1/images/FOTO/{{$datadetail->FOTO}}" width="100" height="100" alt="User"></td>
                        
                      </tr>

                      <tr>
                        <td>Nama</td>
                        <td style="padding-left: 5px">:</td>
                        <td style="padding-left: 5px">{{$datadetail->NAMA}}</td>
                      </tr>
                      <tr>
                        <td>Username</td>
                        <td style="padding-left: 5px">:</td>
                        <td style="padding-left: 5px">{{$datadetail->USERNAME}}</td>
                      </tr>
                      <tr>
                        <td>Password</td>
                        <td style="padding-left: 5px">:</td>
                        <td style="padding-left: 5px">{{$datadetail->PASSWORD}}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td style="padding-left: 5px">:</td>
                        <td style="padding-left: 5px">{{$datadetail->ALAMAT}}</td>
                      </tr>
                      <tr>
                        <td>No Telepon</td>
                        <td style="padding-left: 5px">:</td>
                        <td style="padding-left: 5px">{{$datadetail->NO_TELP}}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td style="padding-left: 5px">:</td>
                        <td style="padding-left: 5px">{{$datadetail->EMAIL}}</td>
                      </tr>
                     
                      @endforeach
                  </table>
                  </div>
            </div>
          </div>
        </div></div>


@endforeach
@endsection