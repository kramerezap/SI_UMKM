@extends('admin/base')
@section('extrastyle')
<?php
$amdet = DB::SELECT("select * from det_transaksi a, produk b where a.ID_PRODUK = b.ID_PRODUK and STATUS='1'");
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
					<th>Produk</th>
					<th>No Nota</th>
					<th>Jumlah</th>
					<th>Total Harga</th>
					
				</tr>
			</thead>
			<tbody>
				<?php $jum = 0; ?>
				  @php $no = 1;

                      @endphp
				@foreach($amdet as $data)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$data->NAMA_PRODUK}}</td>
					<td>{{$data->NO_NOTA}}</td>
					<td>{{$data->JUMLAH}}</td>
					<td>{{$data->TOTAL_HARGA}}</td>
					
				</tr>
				
			</tbody>
			<?php $jum += $data->TOTAL_HARGA;?>
			@endforeach
			
			

						

</table>
<form action="/checkouttransaksi" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                      <div class="card-body">
                      	<div class="col-md-12">
                              <div class="col-md-7">
                                  <div class="form-group">
                                    <label for="first-name-vertical">No Nota</label>
                                      <input type="text" id="first-name-vertical" class="form-control" name="kode" value="{{$kode}}" required="" readonly="">
                                  </div>
                              </div>
                              <div class="col-md-7">
                                  <div class="form-group">
                                      <label for="password-vertical">Nama Pelanggan</label>
                                      <select class="form-control" name="pelanggan" id="pelanggan">
										
										@foreach($napel as $npl)
										<option value="{{$npl->NAMA}}">{{$npl->NAMA}}</option>
										@endforeach
						</select>
                                  </div>
                              </div>
                               <div class="col-md-3" style="margin-top: 28px">
                              	<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-tambahpl">Tambah Pelanggan</button>
                              	</div>

                              <div class="col-md-7">
                                  <div class="form-group">
                                      <label for="password-vertical">Nama Admin</label>
                                      <input type="text" class="form-control" name="admin" placeholder="Nama Admin" value="{{Session::get('NAMA')}}" autocomplete="off" readonly="">
                                  </div>
                              </div>
                                <div class="col-md-7">
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Total</label>
                                      
                                            <input type="number" class="form-control" name="total" value="{{$total}}" id="hasil" required="" readonly="" onkeyup="buy();">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Bayar</label>
                                            <input type="number"class="form-control" name="bayar" placeholder="Bayar" id="bayar" autocomplete="off" required="" onkeyup="buy();">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="password-vertical">Kembalian</label>
                                          <input type="text" class="form-control" name="kembali" placeholder="Kembalian" id="kembali" autocomplete="off" required="" readonly="">
                                      </div>
                                    </div>
                                  </div>
                                </div>                     
                              <input type="hidden" class="form-control" name="akun" value="{{Session::get('ID_USER')}}" readonly="">
                          </div>
                          <div class="col-md-7" style="text-align: right;">
                          		<a href="/transaksi" class="btn btn-danger"><i class="feather icon-x-circle"></i> Batal</a>
		                        <button class="btn btn-primary"><i class="feather icon-check-circle"></i> Bayar</button>
		                  </div>
                    </div>
                    </form>

</div></div></div>
</div></div>
		
<div class="modal fade" id="modal-tambahpl">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Input</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/tambahpelanggantr" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="card-body">
                 
             

                 <input type="hidden" class="form-control" value="{{$kode}}" id="NAMA" name="kode">
                                <input type="hidden" class="form-control" value="{{$total}}" id="NAMA" name="total">


                   <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Nama :</label>
                         <input type="text" class="form-control" id="NAMA" name="NAMA" placeholder="" required="true" autocomplete="off">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Username :</label>
                         <input type="text" class="form-control" id="USERNAME" name="USERNAME" placeholder="" required="true" autocomplete="off">
               
                  </div>
                  <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Password :</label>
                         <input type="text" class="form-control" id="PASSWORD" name="PASSWORD" placeholder="" required="true" autocomplete="off">
               
                  </div> <!-- <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Alamat :</label>
                         <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" placeholder="" required="true" autocomplete="off">
               
                  </div> <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">No Telp :</label>
                         <input type="text" class="form-control" id="NO_TELP" name="NO_TELP" placeholder="" required="true" autocomplete="off">
               
                  </div> <div class="form-group">
                    
                     <label class="col-sm-8 col-sm-8 control-label">Email:</label>
                         <input type="text" class="form-control" id="EMAIL" name="EMAIL" placeholder="" required="true" autocomplete="off">
               
                  </div> -->
                                          
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
		