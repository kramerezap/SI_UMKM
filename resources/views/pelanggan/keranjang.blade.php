@extends('pelanggan/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardpelanggan" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="/cabpemesanan" class=""><i class="lnr lnr-cart"></i> <span>Pemesanan</span></a></li>
                        <li><a href="/pembayaran" class=""><i class="lnr lnr-dice"></i> <span>Pembayaran</span></a></li>
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
                <h3 class="panel-title">Keranjang</h3>
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
                @foreach($cker as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->NO_NOTA}}</td>
                    <td>{{$data->NAMA}}</td>
                    <td>{{$data->NAMA_PRODUK}}</td>
                    <td><?php echo "Rp. ".number_format($data->HARGA)." ,-"; ?></td>
                    <td>{{$data->JUMLAH}}</td>
                    <td><?php echo "Rp. ".number_format($data->TOTAL_HARGA)." ,-"; ?></td>
                    
                    
                </tr>
                
            </tbody>
            <?php $jum += $data->TOTAL_HARGA;?>

            @endforeach
            <tfoot>
                <th colspan="6">TOTAL BAYAR :</th>
                <th><?php echo "Rp. ".number_format($jum)." ,-"; ?></th>
                
            </tfoot>
             

</table>
@foreach($cknot as $not)
<form role="form" action="/checkoutpsn" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                
                <input type="hidden"  class="form-control" name="NO_NOTA" value="{{$not->NO_NOTA}}" required="" readonly="">
                <div class="col-md-12" style="text-align: right;">
                <button type="submit" class="btn btn-danger" style="float: right;">Checkout</button>
         
                          </div>
                      </form>
                     @endforeach
</div></div></div>
</div></div>
		
@endsection