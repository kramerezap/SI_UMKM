@extends('pemilik/base')
@section('extrastyle')
<?php

?>
@endsection
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
									<h3 class="panel-title">Persetujuan Stok Produk</h3>
								</div>
							
								<div class="panel-body">
									 <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
										<thead>
											<tr>
                        <th>No</th>
												<th>Nama Cabang</th>
                        <th>Nama Produk</th>
												<th>Jumlah</th>
												<th>Persetujuan</th>
											</tr>
										</thead>
										<tbody>
                        @php $no = 1;

                      @endphp
											@foreach($cek as $data)
											<tr>
												<td>{{$no++}}</td>
                        <td>{{$data->NAMA_CABANG}}</td>
                        <td>{{$data->NAMA_PRODUK}}</td>
												<td>{{$data->JUMLAH}}</td>
												
												<td> 
													
                                   					 <!-- <a href="/admin:hapusstok={{$data->ID_STOKK}}"  class="btn btn-danger btn-xs"  onclick="return(confirm('Anda Yakin Menghapus?? ')
                                   					 );"><span class="lnr lnr-trash"></span>
                                   					 </a> -->
                    
                    <form role="form" action="/pemilik:persetujuan={{$data->ID_STOKK}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" class="form-control" id="TGL_EXPIRED" name="TGL_EXPIRED" value="{{$data->TGL_EXPIRED}}" required="true" readonly>
                <input type="hidden" class="form-control" id="KETERANGAN" name="KETERANGAN" value="{{$data->KETERANGAN}}" required="true" readonly>
                <input type="hidden" class="form-control" id="ID_STOKK" name="ID_STOKK" value="{{$data->ID_STOKK}}" required="true" readonly>
                <input type="hidden" class="form-control" id="ID_CABANG" name="ID_CABANG" value="{{$data->ID_CABANG}}" required="true" readonly>
                    <input type="hidden" class="form-control" id="ID_PRODUK" name="ID_PRODUK" value="{{$data->ID_PRODUK}}" required="true" readonly>
                    <input type="hidden" class="form-control" id="JUMLAH" name="JUMLAH" value="{{$data->JUMLAH}}" required="true" readonly>
                    <button type="submit"  class="btn btn-warning btn-xs" "><span class="lnr lnr-checkmark-circle"> Setuju</span></button> 
                 </form>
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

          



@endsection