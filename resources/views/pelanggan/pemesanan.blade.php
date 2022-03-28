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
                    @foreach($namcab as $cab)
                    <span>{{$cab->NAMA_CABANG}}<br>
                        {{$cab->LOKASI}}
                    </span>
                    @endforeach
                    <div class="row">
                    <div class="col-md-8">
                <div class="row">
                <!-- <form action="/laporan" style="margin-left: 20px">
                    {{csrf_field()}}
                    <input type="text" name="cari">
                    <button type="submit"><i class="fa fa-search"></i></button>

                    
                </form> -->

                <br>

                         @foreach($tmen as $data)
                        <div class="col-md-4">
                            <!-- PANEL NO PADDING -->
                            <div class="panel">
                               
                                <div class="panel-body no-padding text-center">
                                    <img src="Assets1/images/FOTO_PRODUK/{{$data->FOTO}}" style="width: 100%;">
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$data->NAMA_PRODUK}} </h3>
                                    <span class="panel-body" style="padding-top: -50px;">
                                       Expired : <?= date('d M Y',strtotime($data->TGL_EXPIRED));?>
                                        <br>
                                        Harga : <?php echo "Rp. ".number_format($data->HARGA)." ,-"; ?><br><br>
                                    <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modal-addkrj{{$data->ID_STOK}}" ><i class="lnr lnr-cart"></i> Beli</a></span>
                                    
                                    
                                </div>
                                
                            </div>
                            <!-- END PANEL NO PADDING -->
                        </div>
                        @endforeach
                    </div>
                    </div>
                        <div class="col-md-4">
                         <div class="panel-body" style="background-color: white;margin-top: 22px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $jum = 0; ?>
                              
                                @foreach($cker as $data)
                                <tr>
                                    <td>{{$data->NAMA_PRODUK}}</td>
                                    <td>{{$data->JUMLAH}}</td>
                                    <td><?php echo "Rp. ".number_format($data->TOTAL_HARGA)." ,-"; ?></td>
                                    
                                </tr>
                                <?php $jum += $data->TOTAL_HARGA;?>
                                 @endforeach
                            </tbody>
                             <tfoot>
                                <th colspan="2">TOTAL BAYAR :</th>
                                <th><?php echo "Rp. ".number_format($jum)." ,-"; ?></th>
                                
                            </tfoot>
                           </table>
                           @foreach($cknot as $not)
                        <form role="form" action="/checkoutpsn" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        
                                        <input type="hidden"  class="form-control" name="NO_NOTA" value="{{$not->NO_NOTA}}" required="" readonly="">
                                        <input type="hidden"  class="form-control" name="jum" value="{{$jum}}" required="" readonly="">
                                        @foreach($inus as $user)
                                        <input type="hidden"  class="form-control" name="user" value="{{$user->ID_USER}}" required="" readonly="">
                                        @endforeach
                                        <div class="col-md-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-danger" style="float: right;">Checkout</button>
         
                          </div>
                      </form>
                     @endforeach
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
 @foreach($tmen as $data2)
  <div class="modal fade" id="modal-addkrj{{$data2->ID_STOK}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pesanan</h4>
            </div>
            <form role="form" action="/tmbhpesan" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
             
                <style type="text/css">
                    table tr td{
                        padding-right: 10px;
                    }
                </style>
                @php
                $stt = DB::SELECT("select * from stok_cabang a, produk b where ID_STOK='$data2->ID_STOK' and a.ID_PRODUK=b.ID_PRODUK");
                @endphp
                @foreach($stt as $st)
                <input type="hidden" autocomplete="off" value="{{$st->ID_CABANG}}" class="form-control" id="ICAB" name="ICAB" required="true">
                <input type="hidden" autocomplete="off" value="{{$st->JUMLAH}}" class="form-control" id="ST" name="ST" required="true">
                <input type="hidden" autocomplete="off" value="{{$st->ID_PRODUK}}" class="form-control" id="PRODUK" name="PRODUK" required="true">
                 <input type="hidden" autocomplete="off" value="{{$st->HARGA}}" class="form-control" id="HRG" name="HRG" required="true">
                 <input type="hidden" autocomplete="off" value="{{Session::GET('ID_USER')}}" class="form-control" id="IDU" name="IDU" required="true">
                 <?php if($cid == null) {?>
                        <input type="hidden" id="first-name-vertical" class="form-control" name="NO_NOTA" value="<?php echo date('Ymd');?>0001" required="" readonly="">
                        <?php }else{?>
                          @foreach($idt as $id)
                          <input type="hidden" id="first-name-vertical" class="form-control" name="NO_NOTA" value="{{$id->NO_NOTA+1}}" required="" readonly="">
                          @endforeach
                        <?php } ?>
                @endforeach

               <table>
                <tr>
                    <td style="">Cabang</td>
                    <td style="">:</td>
                    <td style="">{{$data2->NAMA_CABANG}}</td>
                </tr>
                <tr>
                    <td style="">Lokasi</td>
                    <td style="">:</td>
                    <td style="">{{$data2->LOKASI}}</td>
                </tr>
                <tr>
                    <td style="">Produk</td>
                    <td style="">:</td>
                    <td style="">{{$data2->NAMA_PRODUK}}</td>
                </tr>
                <tr>
                    <td style="">Stok</td>
                    <td style="">:</td>
                    <td style="">{{$data2->JUMLAH}}</td>
                </tr>
                <tr>
                    <td style="">Keterangan</td>
                    <td style="">:</td>
                    <td style="width: 50%;padding-top: 12px"><textarea readonly="" style="">{{$data2->KETERANGAN}}</textarea></td>
                </tr>
                    <tr>
                        <td style="padding: 13px 0px 6px 0px">Jumlah</td>
                        <td colspan="3" style="padding: 13px 0px 6px 0px"><input type="number" autocomplete="off" class="form-control" id="JUMLAH" name="JUMLAH" required="true"></td>
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
        </div>
    @endforeach
@endsection