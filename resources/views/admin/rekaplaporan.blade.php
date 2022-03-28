@extends('admin/base')
	
@section('extrastyle')
<?php
?>
@endsection
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
						<li><a href="/jadwalpengiriman" class=""><i class="lnr lnr-calendar-full"></i> <span>Jadwal Pengiriman</span></a></li>
						
						
						<li>
							<a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages3" class="collapse ">
								<ul class="nav">
									<li><a href="/rekaplaporan" class="active">Cetak Laporan</a></li>
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
	<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Rekap</h3>
			</div>
	<div class="panel-body">
	<div class="row">
			<div class="col-md-12" style="">
				
					<a href="/admin:cetaklaporan" class="btn btn-info btn-xs"><span class="lnr lnr-download"> Cetak Laporan</a>
				
					
				<br>
				<br>
		<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Admin</th>
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
					<td>{{$data->NAMA}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->NAMA_PEMESAN}}</td>
					<td>{{$data->TGL_PESAN}}</td>
					<td><?php echo "Rp. ".number_format($data->TOTAL)." ,-"; ?></td>
					<td><?php echo "Rp. ".number_format($data->BAYAR)." ,-"; ?></td>
					<td><?php echo "Rp. ".number_format($data->KEMBALI)." ,-"; ?></td>
					<td>
					<a  href="/admin:cetaknota={{$data->NO_NOTA}}" class="btn btn-warning btn-xs">
                          <span class="lnr lnr-download"></span></a>
                          </td>
				</tr>
				
				@endforeach
			</tbody>
			
			

						

</table>

</div></div></div>
</div></div>

	<script>
	
		
       function buy() {
          var hasil = document.getElementById('hasil').value;
          var bayar = document.getElementById('bayar').value;
         

          var total = parseInt(bayar) - parseInt(hasil);
          
          if (!isNaN(total)) {
             document.getElementById('kembali').value = total;
          }
    }  ;

       
          
  </script>
  
@endsection
			<!-- END MAIN CONTENT -->
		