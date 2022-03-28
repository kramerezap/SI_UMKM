@extends('pemilik/base')
@section('extrastyle')
<?php
$ambilcabang = DB::SELECT("select * from cabang where STATUS_HAPUS='1'");
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
									 --><li><a href="/validasiadmin" class="">Admin</a></li>
                  <li><a href="/cabang" class="active">Cabang</a></li>
									<li><a href="/valpelanggan" class="">Pelanggan</a></li>
								</ul>
							</div>
						</li>
						<!-- <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Jadwal Produksi</span></a></li>
						 --><li>
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Daftar</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<!-- <li><a href="/bahanbakupemilik" class="">Bahan</a></li>
								 -->	<li><a href="/cekproduk" class="">Produk</a></li>
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
<div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Input</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/tambahcabang" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
               
                  </div>
                   
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama Cabang :</label>
                         <input type="text" class="form-control" id="NAMA_CABANG" name="NAMA_CABANG" placeholder="" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Lokasi :</label>
                         <input type="text" class="form-control" id="LOKASI" name="LOKASI" placeholder="" required="true">
               
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
      $dat = DB::table('cabang')->get();
      @endphp
      @foreach($dat as $data)  
      <div class="modal fade" id="modal-edit{{$data->ID_CABANG}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/editcabang={{$data->ID_CABANG}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
               
                  </div>
                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama Cabang :</label>
                         <input type="text" class="form-control" id="NAMA_CABANG" name="NAMA_CABANG" placeholder="Username" value="{{$data->NAMA_CABANG}}" required="true">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Lokasi :</label>
                         <input type="text" class="form-control" id="LOKASI" name="LOKASI" placeholder="Password" value="{{$data->LOKASI}}" required="true">
               
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

		<div class="row">
						<div class="col-md-12">

							<!-- BORDERED TABLE -->
							<div class="panel" style="margin-top: 100px;margin-left: 300px">
								<div class="panel-heading" >
									<h3 class="panel-title">Data Cabang</h3>
								</div>
								<button type="button" class="btn btn-primary" style="margin-left: 25px" data-toggle="modal" data-target="#modal-tambah">Tambah</button>
								<div class="panel-body">
									<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Cabang</th>
												<th>Lokasi</th>
												<th>Etc.</th>
											</tr>
										</thead>
										<tbody>
                        @php $no = 1;

                      @endphp
											@foreach($ambilcabang as $data)
											<tr>
												<td>{{$no++}}</td>
												<td>{{$data->NAMA_CABANG}}</td>
												<td>{{$data->LOKASI}}</td>
										
												<td> 
												<a  href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit{{$data->ID_CABANG}}">
                                       				 <span class="lnr lnr-pencil"></span>
                                   					 </a>
                                   					 <a href="/pemilik:hapuscabang={{$data->ID_CABANG}}"  class="btn btn-danger btn-xs"  onclick="return(confirm('Anda Yakin Menghapus?? ')
                                   					 );"><span class="lnr lnr-trash"></span>
                                   					 </a></td>
											</tr>
											
                    @endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
@endsection