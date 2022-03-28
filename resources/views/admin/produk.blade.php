@extends('admin/base')
@section('extrastyle')
<?php

$ablpro = DB::SELECT("select * from produk");
?>
@endsection
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="/dashboardadmin" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
            <li><a href="/valpelangganadm" class=""><i class="lnr lnr-heart"></i> <span>Pelanggan</span></a></li>
            <li><a href="/produk" class="active"><i class="lnr lnr-alarm"></i> <span>Produk</span></a></li>
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
<div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
		<div class="row">
						<div class="col-md-12">

							<!-- BORDERED TABLE -->
							<div class="panel" style="">
								<div class="panel-heading" >
									<h3 class="panel-title">Data Stok Produk</h3>
								</div>
								<button type="button" class="btn btn-primary" style="margin-left: 25px" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
								<div class="panel-body">
									<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Tgl Expired</th>
												<th>Keterangan</th>
												<th>Etc.</th>
											</tr>
										</thead>
										<tbody>
                        @php $no = 1;

                      @endphp
											@foreach($cek as $data)
											<tr>
												<td>{{$no++}}</td>
                        <td>{{$data->NAMA_PRODUK}}</td>
                        <td>{{$data->JUMLAH}}</td>
                        <td><?= date('d M Y',strtotime($data->TGL_EXPIRED));?></td>
                        <td>{{$data->KETERANGAN}}</td>
												
												<td> 
													 <a  href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-editexp{{$data->ID_STOK}}">
                                       				 <span class="lnr lnr-pencil"></span>
                                   					 </a>
                                   					 <a href="/admin:hapusstok={{$data->ID_STOK}}"  class="btn btn-danger btn-xs"  onclick="return(confirm('Anda Yakin Menghapus?? ')
                                   					 );"><span class="lnr lnr-trash"></span>
                                   					 </a></td>
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
              <form role="form" action="/tambahstok" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
             

                <div class="form-group">
                   <input type="hidden" class="form-control" id="ID_CABANG" name="ID_CABANG" value="{{Session::get('ID_CABANG')}}" required="true" readonly>

                      <label class="col-sm-8 col-sm-8 control-label">Produk :</label>
                      <select class="form-control" id="ID_PRODUK" name="ID_PRODUK">
                        @foreach($ablpro as $proabl)
                          <option value="{{$proabl->ID_PRODUK}}" selected="">{{$proabl->NAMA_PRODUK}}</option>
                          @endforeach
                </select>
                     </div>

                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Jumlah :</label>
                         <input type="number" class="form-control" id="JUMLAH" name="JUMLAH" placeholder="" required="true">
               
                  </div>
                           <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Tanggal Expired :</label>
                         <input type="date" class="form-control" id="TGL_EXPIRED" name="TGL_EXPIRED" placeholder="" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Keterangan :</label>
                         <input type="text" class="form-control" id="KETERANGAN" name="KETERANGAN" placeholder="" required="true">
               
                  </div>                
                    <br><br>


                </div>
                <!-- /.card-body -->

                <div class="modal-footer justify-content-between">
             <button type="submit" class="btn btn-primary" style="float: right;" onclick="return(confirm('Menunggu Persetujuan Pemilik') );">Simpan</button>
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
      $dat = DB::table('stok_cabang')->get();
      @endphp
      @foreach($dat as $data)  
      <div class="modal fade" id="modal-editexp{{$data->ID_STOK}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/editexp={{$data->ID_STOK}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
               
                  </div>

                  
                     <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Tanggal Expired :</label>
                         <input type="date" class="form-control" id="TGL_EXPIRED" name="TGL_EXPIRED" placeholder="" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Keterangan :</label>
                         <input type="text" class="form-control" id="KETERANGAN" name="KETERANGAN" placeholder="" required="true">
               
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

@endsection