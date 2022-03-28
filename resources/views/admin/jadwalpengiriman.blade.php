@extends('admin/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardadmin" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/valpelangganadm" class=""><i class="lnr lnr-heart"></i> <span>Pelanggan</span></a></li>
						<li><a href="/produk" class=""><i class="lnr lnr-alarm"></i> <span>Produk</span></a></li>
						<li><a href="/transaksi" class=""><i class="lnr lnr-cart"></i> <span>Transaksi</span></a></li>
            <li><a href="/trpemesanan" class=""><i class="lnr lnr-book"></i> <span>Pemesanan</span></a></li>
						<li><a href="/jadwalpengiriman" class="active"><i class="lnr lnr-calendar-full"></i> <span>Jadwal Pengiriman</span></a></li>
						
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
												<th>Tanggal Pengiriman</th>
												<!-- <th>Status Pengiriman</th> -->
												<th >Tujuan</th>
												<th>Keterangan</th>
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
												<td>{{$data->TGL_PENGIRIMAN}}</td>
												<!-- <td>{{$data->STATUS_PENGIRIMAN}}</td> -->
												<td>{{$data->TUJUAN_PENGIRIMAN}}</td>
												<td style=""> 
						
                					  <a  href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-detail{{$data->NO_NOTA}}"><span class=" fa fa-info-circle"></span></a>
                		  

                					   @if($data->STATUS_PENGIRIMAN == 'Belum Terkirim')
                                   					  <a  href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-upd{{$data->ID_TRANSAKSI}}">
                                       				 <span class="lnr lnr-checkmark-circle"></span>
                                   					 </a>
                                   		@else
                                   		 <a  class="btn btn-success btn-xs">
                                       				 <span class="lnr lnr-checkmark-circle"></span>
                                   					 </a>
                                   		@endif
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

     @foreach($jadwal as $data3)
     <div class="modal fade" id="modal-upd{{$data3->ID_TRANSAKSI}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail</h4>
            </div>
         <form role="form" action="/updjdwl={{$data3->ID_TRANSAKSI}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
             
                
     			<style type="text/css">
     				table tr td{
     					padding-right: 10px;
     				}
     			</style>

               <table>
                    <tr>
                        <td style="">Tujuan Pengiriman</td>
                        <td colspan="1" style=""><input type="text" autocomplete="off" class="form-control" id="TUJ" name="TUJ" required="true"></td>
                    </tr>
                   
                  </table>
                  </div>
                  <div class="modal-footer">
                  	<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                  </div>
              </form>
            </div>
          </div>
        </div></div>
		@endforeach
@endsection