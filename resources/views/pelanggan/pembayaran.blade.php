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
						<li><a href="/pembayaran" class="active"><i class="lnr lnr-dice"></i> <span>Pembayaran</span></a></li>
						<li><a href="/riwayatpemesanan" class=""><i class="lnr lnr-book"></i> <span>Riwayat Pemesanan</span></a></li>
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
					<th>No Nota</th>
					<th>Cabang</th>
					<th>Tanggal Pesan</th>
					<th>Total</th>
					<th>Bukti Pembayaran</th>
					<th>Detail</th>
					<th>Bayar</th>
				</tr>
			</thead>
			<tbody>
				<?php $jum = 0; ?>
				  @php $no = 1;

                      @endphp
				@foreach($trans as $data)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->NAMA_CABANG}}</td>
					<td>{{$data->TGL_PESAN}}</td>
					<td><?php echo "Rp. ".number_format($data->TOTAL)." ,-"; ?></td>
          @if($data->BUKTI_PEMBAYARAN == NULL)
          <td></td>
          @else
					<td><center><img src="Assets1/images/BUKTI_PEMBAYARAN/{{$data->BUKTI_PEMBAYARAN}}" width="75" height="65" alt="User"></center></td>
          @endif
					<td> <a  href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-detail{{$data->NO_NOTA}}"><span class=" fa fa-info-circle"></span></a></td>
					
				    <td><a  href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-bayar{{$data->NO_NOTA}}">
                          <span class="fa fa-dollar"></span></a>
                          
                          </td>
				</tr>
				
        @endforeach
			</tbody>
			
			

						

</table>

</div></div></div>
</div></div>


@foreach($trans as $data2)  
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

     @foreach($trans as $data3)  
  <div class="modal fade" id="modal-bayar{{$data3->NO_NOTA}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Kirim Bukti Pembayaran</h4>
            </div>
            <form role="form" action="/tmbhbukti={{$data3->NO_NOTA}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
             
     			<style type="text/css">
     				table tr td{
     					padding-right: 10px;
     				}
     			</style>

               <table>
                    <tr>
	                    <td style="padding-bottom: 6px">Bukti Pembayaran :</td>
                    </tr>
                      
                  	<tr>
	                   <td style="padding-bottom: 6px"> <input type="file" class="form-control" name="BUKTI" style="width: 100%;"></td>
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
			<!-- END MAIN CONTENT -->
			