@extends('admin/base')
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
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <h3 class="page-title">Panels</h3>
                    <div class="row">
                         @foreach($tmenu as $data)
                        <div class="col-md-3">
                            <!-- PANEL NO PADDING -->
                            <div class="panel">
                               
                                <div class="panel-body no-padding text-center">
                                    <img src="Assets1/images/FOTO_PRODUK/{{$data->FOTO}}" style="width: 100%;">
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$data->NAMA_PRODUK}}}</h3>
                                    <div class="right">
                                        <a href="/edkomenadm={{$data->ID_PRODUK}}"><i class="fa fa-comment"></i></a>
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