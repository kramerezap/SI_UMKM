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
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">Menu</h3>
                    <div class="row">
                         @foreach($tmenu as $data)
                        <div class="col-md-3">
                            <!-- PANEL NO PADDING -->
                            <div class="panel">
                               
                                <div class="panel-body no-padding text-center">
                                    <img src="Assets1/images/FOTO_PRODUK/{{$data->FOTO}}" style="width: 100%;">
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$data->NAMA_PRODUK}}</h3>
                                    <div class="right">
                                        <a href="/edkomenpl={{$data->ID_PRODUK}}"><i class="fa fa-comment"></i></a>
                                    </div>
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