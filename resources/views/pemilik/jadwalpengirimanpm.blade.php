@extends('pemilik/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardpemilik" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li>
							<a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-code"></i> <span>Validasi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse ">
								<ul class="nav">
									<!-- <li><a href="page-profile.html" class="">Pemesanan</a></li>
									 --><li><a href="/validasiadmin" class="">Admin</a></li>
                 					 <li><a href="/cabang" class="">Cabang</a></li>
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
									 --><li><a href="/cekproduk" class="">Produk</a></li>
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
						<div class="col-md-12">

							<!-- BORDERED TABLE -->
							<div class="panel" style="">
								<div class="panel-heading" >
									<h3 class="panel-title">Jadwal Pengiriman</h3>
								</div>
								<!-- <button type="button" class="btn btn-primary" style="margin-left: 25px" data-toggle="modal" data-target="#modal-tambah">Tambah</button> -->
								<div class="panel-body">
									<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
                       						    <th>No Nota</th>
												<th>Nama Pemesan</th>
												<th>Tanggal Pesan</th>
												<th>Status Pengiriman</th>
												<th>Tanggal Pengiriman</th>
												<th>Etc</th>
											</tr>
										</thead>
										<tbody>
                        @php $no = 1;

                      @endphp
											@foreach($jadwal as $data)
											<tr>
												<td>{{$no++}}</td>
												<td>{{$data->NO_NOTA}}</td>
                        						<td>{{$data->NAMA_PEMESAN}}</td>
												<td>{{$data->TGL_PESAN}}</td>
												<td>{{$data->STATUS_PENGIRIMAN}}</td>
												<td>{{$data->TGL_PENGIRIMAN}}</td>
												<td> 
						
                					  <a  href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-detail{{$data->NO_NOTA}}"><span class=" fa fa-info-circle"></span></a>
                		  
                                   					</td>
											</tr>
											@endforeach
										</tbody>
										
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
					</div>
				</div>
			</div>
		</div>

		@foreach($jadwal as $data2)  
  <div class="modal fade" id="modal-detail{{$data2->NO_NOTA}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail</h4>
            </div>
            <div class="modal-body">
             
                  @php 
                      $id = $data2->NO_NOTA;
                      $detjdwl = DB::SELECT("SELECT * FROM det_transaksi a, produk b where NO_NOTA='$id' and a.ID_PRODUK= b.ID_PRODUK");
                  @endphp
     			<style type="text/css">
     				table tr td{
     					padding-right: 10px;
     				}
     			</style>

               <table>
                    <tr>
	                    <td style="padding-bottom: 6px">Produk</td>
	                    <td style="padding-bottom: 6px">Jumlah</td>
                    </tr>
                    @foreach($detjdwl as $data3)  
                  	<tr>
	                    <td style="padding-right:50px;">{{$data3->NAMA_PRODUK}}</td>
	                    <td style="text-align: center;">{{$data3->JUMLAH}}</td>
                  	</tr>
                    @endforeach
                  </table>
                  </div>
                  <div class="modal-footer">
                  	<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                  </div>
            </div>
          </div>
        </div></div>

     @endforeach
@endsection