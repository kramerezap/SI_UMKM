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
						<li><a href="/transaksi" class="active"><i class="lnr lnr-cart"></i> <span>Transaksi</span></a></li>
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
	<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Transaksi</h3>
			</div>
	<div class="panel-body">
	<div class="row">
			<div class="col-md-10" style="">
				<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>No Nota</th>
					<th>Pemesan</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php $jum = 0; ?>
				  @php $no = 1;

                      @endphp
				@foreach($det as $data)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->NAMA_PEMESAN}}</td>
					<td>{{$data->NAMA_PRODUK}}</td>
					<td><?php echo "Rp. ".number_format($data->HARGA)." ,-"; ?></td>
					<td>{{$data->JUMLAH}}</td>
					<td><?php echo "Rp. ".number_format($data->TOTAL_HARGA)." ,-"; ?></td>
					
					
				</tr>
				
			</tbody>
			<?php $jum += $data->TOTAL_HARGA;?>

			@endforeach
			<tfoot>
				<th colspan="6">Kembali :</th>
				<th><?php echo "Rp. ".number_format($kembali)." ,-"; ?></th>
				
			</tfoot>
			<tfoot>
				<th colspan="6">Total Belanja :</th>
				<th><?php echo "Rp. ".number_format($total)." ,-"; ?></th>
				
			</tfoot>
			<tfoot>
				<th colspan="6">Bayar :</th>
				<th><?php echo "Rp. ".number_format($bayar)." ,-"; ?></th>
				
			</tfoot>
			
			

						

</table>
<form action="cetak_pdf" method="get" enctype="multipart/form-data">
	{{csrf_field()}}
<div class="col-md-12" style="text-align: right;">

	<input type="hidden" class="form-control" name="kode" value="{{$kode}}">

                          		<button class="btn btn-primary"><i class="feather icon-check-circle"></i> Cetak
		                        </button>
		                        	<a href="/transaksi" class="btn btn-danger"><i class="feather icon-x-circle"></i> Selesai</a>
		                  </div>
		              </form>
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
			<!-- END MAIN CONTENT -->
		