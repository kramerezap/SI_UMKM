@extends('pemilik/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="/dashboardpemilik" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li>
                            <a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-code"></i> <span>Validasi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages1" class="collapse ">
                                <ul class="nav">
                                    <!-- <li><a href="page-profile.html" class="">Pemesanan</a></li>
                                     --><li><a href="/validasiadmin" class="">Admin</a></li>
                                     <li><a href="/cabang" class="">Cabang</a></li>
                                    <li><a href="/valpelanggan" class="">Pelanggan</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Jadwal Produksi</span></a></li>
                         --><li>
                            <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Daftar</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages2" class="collapse ">
                                <ul class="nav">
                                    <!-- <li><a href="/bahanbakupemilik" class="">Bahan</a></li>
                                     --><li><a href="/cekproduk" class="">Produk</a></li>
                                     <li><a href="/tambahstokcabang" class="">Stok</a></li>
                                        <li><a href="/produkcabang" class="">Produk Per Cabang</a></li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subPages3" class="collapse ">
                                <ul class="nav">
                                    <li><a href="/jadwalpengirimanpm" class="">Jadwal Pengiriman</a></li>
                                    <li><a href="/laporan" class="">Laporan</a></li>
                                    <li><a href="/komentarpm" class="">Komentar</a></li>
                                    
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
                                    <h3 class="panel-title">{{$data->NAMA_PRODUK}}</h3>
                                    <div class="right">
                                        <a href="/edkomenpm={{$data->ID_PRODUK}}"><i class="fa fa-comment"></i></a>
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