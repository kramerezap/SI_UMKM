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
		@if($tagg == 1)
		<form action="/addcart" enctype="multipart/form-data">
			{{csrf_field()}}
			@else
			@endif
			<div class="panel-body">
				<div class="row">
					<form action="/search" enctype="multipart/form-data">
              {{csrf_field()}}
					<div class="col-md-4">
 		@if($tagg == 2)
 		<label class="col-sm-8 col-sm-8 control-label">Masukkan Produk :</label>
						<select class="form-control" name="produk" id="produk">
							<option></option>
							@foreach($produk as $prodabl)
							<option value="{{$prodabl->ID_PRODUK}}">{{$prodabl->NAMA_PRODUK}}</option>
							@endforeach
						</select>
						@else
						 @foreach($harga as $hargass)
						<input type="text" class="form-control" name="" value="{{$hargass->NAMA_PRODUK}}" readonly>
						<input type="hidden" class="form-control" name="ID_PRODUK" value="{{$hargass->ID_PRODUK}}" readonly>
						<input type="hidden" class="form-control" name="SESSION_CABANG" value="{{Session::get('ID_CABANG')}}" readonly>
						@endforeach 
						 <?php if($cid == null) {?>
                        <input type="hidden" id="first-name-vertical" class="form-control" name="NO_NOTA" value="<?php echo date('Ymd');?>0001" required="" readonly="">
                        <?php }else{?>
                          @foreach($idt as $id)
                          <input type="hidden" id="first-name-vertical" class="form-control" name="NO_NOTA" value="{{$id->NO_NOTA+1}}" required="" readonly="">
                          @endforeach
                        <?php } ?>
						@endif
						
						@if($tagg == 2)
						<button class="btn btn-primary" style="margin-top: 10px">Search</button>
						@else
						@endif
					</div>

					</form>

					
				
					<?php if($stat == 1){

					}else{?>
						
						@foreach($harga as $hargas)
						<div class="col-md-6 well">
						<div class="col-md-6">
						<div class="form-group">
							<label>Harga :</label>
						<input type="number" class="form-control" value="{{$hargas->HARGA}}" id="harga" name="HARGA" readonly onkeyup="hitung();">  
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Stok :</label>
						<input type="text" class="form-control" value="{{$hargas->JUMLAH}}" name="ST"  readonly ">
					</div>
					</div>
					@endforeach
					<div class="col-md-6">
						<div class="form-group">
							<label>Jumlah :</label>
						<input type="number" class="form-control" id="jumlah" max="{{$hargas->JUMLAH}}" name="JUMLAH" onkeyup="hitung();">
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Total :</label>
						<input type="text" class="form-control" readonly name="TOTAL_HARGA" id="total">
					</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
						</div>
					</div>
					<div class="col-md-6" style="text-align: right;">
						<div class="form-group" >
							@if($tagg == 1)
					<a href="/transaksi" class="btn btn-default" >Batal</a>
              		<button type="submit" class="btn btn-primary" >Simpan</button>
              		@else
					@endif
              		</div>
					</div>
				</div>

			<?php } ?>

   


					
			@if($tagg == 1)
		</form>
			@else
			@endif

		</div>
		<div class="row">
			<div class="col-md-11" style="margin-left: 20px">
				<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>No Nota</th>
					<th>Jumlah</th>
					<th>Total Harga</th>
					<th>Etc.</th>
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
					<td><?php echo "Rp. ".number_format($data->TOTAL_HARGA)." ,-"; ?></td>
					<td><a href="/admin:hapuscart={{$data->ID_DETAIL}}"  class="btn btn-danger btn-xs"  onclick="return(confirm('Anda Yakin Menghapus?? '));"><span class="lnr lnr-trash"></span></a>
					</td>
				</tr>
				
			</tbody>
			<?php $jum += $data->TOTAL_HARGA;?>
			@endforeach
			 <?php if($data == null){

			  }else{?>
			<tfoot>
				<th colspan="4">Total Belanja :</th>
				<th><span><?php echo "Rp. ".number_format($jum)." ,-"; ?> </span> </th>
				<form action="/bayar" method="post" enctype="multipart/form-data">
                                                  {{csrf_field()}}
                                                    <?php if($cid == null) {?>
                                                        <input type="hidden" id="first-name-vertical" class="form-control" name="kode" value="<?php echo date('Ymd');?>0001" required="" readonly="">
                                                        <?php }else{?>
                                                          @foreach($idt as $id)
                                                          <input type="hidden" id="first-name-vertical" class="form-control" name="kode" value="{{$id->NO_NOTA+1}}" required="" readonly="">
                                                          @endforeach
                                                    <?php } ?>
                                                    <input type="hidden" class="form-control" name="total" value="{{$jum}}" id="hasil" required="" readonly="">
                                                  <td colspan="2">
                                                      <button class="btn btn-icon btn-icon btn-block btn-primary"><i class="feather icon-check-circle"></i> Bayar</button>
                                                  </td>
                                                </form>
                                              </tr>
                                         
                                          <?php } ?>
			</tfoot>
		</table>
	</div></div>

					</div>
			</div>

		 <script type="text/javascript">
       function hitung() {
          var harga = document.getElementById('harga').value;
          var jumlah = document.getElementById('jumlah').value;
         

          var total = parseInt(harga) * parseInt(jumlah);
          
          if (!isNaN(total)) {
             document.getElementById('total').value = total;
          }
    }  
        
          
  </script>
@endsection