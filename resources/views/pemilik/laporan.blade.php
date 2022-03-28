@extends('pemilik/base')
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
									<li><a href="/laporan" class="active">Laporan</a></li>
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
	<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Laporan</h3>
			</div>
	<div class="panel-body">
	<div class="row">
			<div class="col-md-12" style="">
				
					<a href="/pemilik:cetaklaporan" class="btn btn-info btn-xs"><span class="lnr lnr-download"> Cetak Laporan</a>
				<br>

				<br>
		<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Cabang</th>
					<th>No Nota</th>
					<th>Pemesan</th>
					<th>Tanggal Pesan</th>
					<th>Total</th>
					<th>Bayar</th>
					<th>Kembali</th>
					<th>Etc</th>
				</tr>
			</thead>
			<tbody>
				<?php $jum = 0; ?>
				  @php $no = 1;

                      @endphp
				@foreach($trans as $data)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$data->NAMA_CABANG}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->NAMA_PEMESAN}}</td>
					<td>{{$data->TGL_PESAN}}</td>
					<td><?php echo "Rp. ".number_format($data->TOTAL)." ,-"; ?></td>
					<td><?php echo "Rp. ".number_format($data->BAYAR)." ,-"; ?></td>
					<td><?php echo "Rp. ".number_format($data->KEMBALI)." ,-"; ?></td>
					<td>
					<a  href="/pemilik:cetaknota={{$data->NO_NOTA}}" class="btn btn-warning btn-xs">
                          <span class="lnr lnr-download"></span></a>
                          </td>
				</tr>
				
				@endforeach
			</tbody>
			
			

						

</table>
</div></div></div>
</div></div>
		
		<script type="text/javascript">
       function buy() {
          var hasil = document.getElementById('hasil').value;
          var bayar = document.getElementById('bayar').value;
         

          var total = parseInt(bayar) - parseInt(hasil);
          
          if (!isNaN(total)) {
             document.getElementById('kembali').value = total;
          }
    }  
    
          
  </script>
  
		
@endsection