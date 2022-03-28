@extends('pelanggan/base')
@section('extrastyle')
<?php
?>
@endsection
@section('sidebar')

<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardpelanggan" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/cabpemesanan" class=""><i class="lnr lnr-cart"></i> <span>Pemesanan</span></a></li>
						<li><a href="/pembayaran" class=""><i class="lnr lnr-dice"></i> <span>Pembayaran</span></a></li>
						<li><a href="/riwayatpemesanan" class="active"><i class="lnr lnr-book"></i> <span>Riwayat Pemesanan</span></a></li>
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
				<br>
		<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0" class="table table-bordered">
			<input type="hidden" class="form-control" name="SESSION_NAMA" value="{{Session::get('NAMA')}}" readonly>
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
					<td>{{$data->adm}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->NAMA_PEMESAN}}</td>
					<td>{{$data->TGL_PESAN}}</td>
					<td>{{$data->TOTAL}}</td>
					<td>{{$data->BAYAR}}</td>
					<td>{{$data->KEMBALI}}</td>
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



      
     

<script type="text/javascript">
	var slider = document.getElementById("myRange");
				var output = document.getElementById("demo");
				output.innerHTML = slider.value; // Display the default slider value

				// Update the current slider value (each time you drag the slider handle)
				slider.oninput = function() {
				  output.innerHTML = this.value;
}	
</script>

<script type="text/javascript">
	var slider = document.getElementById("myRange2");
				var output = document.getElementById("demo2");
				output.innerHTML = slider.value; // Display the default slider value

				// Update the current slider value (each time you drag the slider handle)
				slider.oninput = function() {
				  output.innerHTML = this.value;
}	
</script>


@endsection
			<!-- END MAIN CONTENT -->
			