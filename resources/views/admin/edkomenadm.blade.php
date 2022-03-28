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
                    <h3 class="page-title">Komentar</h3>
                    <div class="row">
                        @foreach($data as $dd)
                        <div class="col-md-3">
                            <!-- PANEL NO PADDING -->
                            <div class="panel">
                               
                                <div class="panel-body no-padding text-center">
                                    <img src="Assets1/images/FOTO_PRODUK/{{$dd->FOTO}}" style="width: 100%;">
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$dd->NAMA_PRODUK}}</h3>
                                    <div class="right">
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <!-- END PANEL NO PADDING -->
                        </div>
                         <div class="col-md-7">
                            <!-- TODO LIST -->
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Komentar</h3>
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                        <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @foreach($tkom as $komt)
                                    <ul class="list-unstyled todo-list">
                                        <li>
                                             
                                            <label class="control-inline fancy-checkbox">
                                               

                                            </label>
                                            
                                            <p>
                                                <span class="title">{{$komt->NAMA}}</span>
                                                <span class="short-description">{{$komt->KOMENTAR}}</span>
                                                
                                                
                                                <span class="date">{{$komt->TANGGAL}}</span>
                                            </p>
                                                   
                                           
                                            <div class="controls">
                                                @if($komt->STATUSKM==1)
                                                <a href="/komen1pm={{$komt->ID_KOMENTAR}}" type="button" class="btn btn-success btn-icon btn-xs" style="margin-left: 8px;"><i class="fas fa-check-circle"></i></a>
                                                
                                                 @else
                                                 <a href="/komen0pm={{$komt->ID_KOMENTAR}}" type="button" class="btn btn-danger btn-icon btn-sm" style="margin-left: 8px;"><i class="fas fa-times-circle"></i></a>
                                                 
                                                 @endif
                                                 <!-- <a href="/hapuskomenpm={{$komt->ID_KOMENTAR}}" onclick="return(confirm('Anda Yakin ?'));" style="margin-right: 8px;color: #f54c4c;"><i class="fa fa-trash"></i></a> -->
                                            </div>
                                           
                                        </li>
                                    </ul>
                                     @endforeach
                                </div>
                            </div>
                            <!-- END TODO LIST -->
                        </div>
                         @endforeach  
                    </div>
                </div>
            </div>
        </div>


@endsection