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
                        @endforeach

                         <div class="col-md-9">
                            <!-- TIMELINE -->
                            <div class="panel panel-scrolling">
                                <div class="panel-heading">
                                    @foreach($jkom as $komj)
                                    <h3 class="panel-title">Komentar( {{$komj->jumkom}} )</h3>
                                    @endforeach
                                    <div class="right">
                                        <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                        
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @foreach($tkom as $komt)

                                    <ul class="list-unstyled activity-list">
                                        <li>
                                            <img style="" src="Assets1/images/FOTO/{{$komt->FOTO}}" alt="Avatar" class="img-circle pull-left avatar">
                                            <p><a href="#">{{$komt->NAMA}}</a> 
                                                @if($komt->STATUSKM==1)
                                                <br>{{$komt->KOMENTAR}} 
                                                <?php 
                                                    $ses = Session::get('ID_USER');
                                                    if($komt->ID_USER == $ses){?>
                                                <a href="/hapuskomenpl={{$komt->ID_KOMENTAR}}" onclick="return(confirm('Anda Yakin ?'));" style="margin-right: 8px;color: #f54c4c;"><i class="fa fa-trash"></i></a> 
                                                <?php }else{  }?>
                                                 <span class="timestamp">{{$komt->TANGGAL}}</span>
                                                @else
                                                <div class="" style="color: #788695;"><i class="fas fa-ban" style="padding-left: 10px;"></i> <i style="background-color: lightgrey;">Komentar ini telah di nonaktifkan</i>
                                                    <?php 
                                                    $ses = Session::get('ID_USER');
                                                    if($komt->ID_USER == $ses){?>
                                                 <a href="/hapuskomenpl={{$komt->ID_KOMENTAR}}" onclick="return(confirm('Anda Yakin ?'));" style="margin-right: 8px;color: #f54c4c;"><i class="fa fa-trash"></i></a> </div> <?php }else{  }?>
                                             </p>
                                                @endif

                                        </li>
                                        
                                    </ul>
                                    <hr>
                                    @endforeach
                                    
                                </div>
                            </div>
                            <!-- END TIMELINE -->
                        </div>
                    <div class="row">
                        <div class="col-md-3" >
                        </div>
                         <div class="col-md-9" style="">
                            <!-- PANEL HEADLINE -->
                            <div class="panel panel-headline">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Beri Komentar</h4>
                                </div>
                                <div class="panel-body">
                                   <form action="/postkomen" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    @foreach($data as $id)
                                    <input type="hidden" name="idp" value="{{$id->ID_PRODUK}}">
                                    <input type="hidden" name="idses" value="{{Session::get('ID_USER')}}">
                                    @endforeach
                                      <textarea class="form-control" name="KOMENTAR" placeholder="" rows="6" required="true"></textarea>
                                        <button type="submit" class="btn btn-primary btn-bottom right-block">Post</button>
                                    </form>
                                </div>
                            </div>
                            <!-- END PANEL HEADLINE -->
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

@endsection