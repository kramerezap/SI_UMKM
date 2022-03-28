@extends('pelanggan/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardpelanggan" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="/cabpemesanan" class="active"><i class="lnr lnr-cart"></i> <span>Pemesanan</span></a></li>
                        <li><a href="/pembayaran" class=""><i class="lnr lnr-dice"></i> <span>Pembayaran</span></a></li>
						<li><a href="/riwayatpemesanan" class=""><i class="lnr lnr-book"></i> <span>Riwayat Pemesanan</span></a></li>
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
                    <h3 class="page-title">Menu</h3>
                <div class="row">
               <!--  <form action="/laporan" style="margin-left: 20px">
                    {{csrf_field()}}
                    <input type="text" name="cari">
                    <button type="submit"><i class="fa fa-search"></i></button>

                    
                </form> -->

                <br>

                         @foreach($tcab as $data)
                        <div class="col-md-3">
                            <!-- PANEL NO PADDING -->
                            <div class="panel">
                                <div class="panel-body no-padding text-center">
                                </div>
                                
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$data->NAMA_CABANG}} </h3>
                                    <span class="panel-body" style="padding-top: -50px;">
                                        Lokasi : {{$data->LOKASI}}<a href="/pemesanan={{$data->ID_CABANG}}" style="float: right;color: blue;"><i class="lnr lnr-cart"></i></a>
                                        </span>
                                    
                                    
                                </div>
                                
                            </div>
                            <!-- END PANEL NO PADDING -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection