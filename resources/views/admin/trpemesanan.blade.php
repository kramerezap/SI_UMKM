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
						<li><a href="/trpemesanan" class="active"><i class="lnr lnr-book"></i> <span>Pemesanan</span></a></li>
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
				<h3 class="panel-title">Validasi Pemesanan</h3>
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
					<th>No Nota</th>
					<th>Nama Pemesan</th>
					<th>Tanggal Pesan</th>
					<th>Total</th>
					<th>Persetujuan</th>
					
				</tr>
			</thead>
			<tbody>
				<?php $jum = 0; ?>
				  @php $no = 1;

                      @endphp
				@foreach($tpem as $data)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->NAMA_PEMESAN}}</td>
					<td>{{$data->TGL_PESAN}}</td>
					<td><?php echo "Rp. ".number_format($data->TOTAL)." ,-"; ?></td>
					
					<td> <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modal-pers{{$data->NO_NOTA}}" ><i class="lnr lnr-checkmark-circle"></i></a></span></td>
				</tr>
				
				@endforeach
			</tbody>
			
			

						

</table>

</div></div></div>
</div></div>

@foreach($tpem as $data2)
  <div class="modal fade" id="modal-pers{{$data2->NO_NOTA}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Persetujuan</h4>
            </div>
            <form role="form" action="/tmbhbayar={{$data2->NO_NOTA}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
             
                <style type="text/css">
                    table tr td{
                        padding-right: 10px;
                    }
                </style>
             
             <center><img src="Assets1/images/BUKTI_PEMBAYARAN/{{$data2->BUKTI_PEMBAYARAN}}" width="180" height="145" alt="User"></center>
               <table>
               
                <tr>
                    <td style="">Total</td>
                    <td style="">:</td>
                    <td style=""><?php echo "Rp. ".number_format($data2->TOTAL)." ,-"; ?></td>
                </tr>
                   <input type="hidden" class="form-control" name="BAYAR" value="{{$data2->TOTAL}}" readonly>
                    
                   
                </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" style="float: right;">Bayar</button>
              
                  </div>
              </form>
            </div>
          </div>
        </div>
        @endforeach
@endsection