<?php
$ses = Session::get('ID_USER');
$datses = DB::SELECT("select * from user where ID_USER='$ses'");
?>
@extends('pemilik/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardpemilik" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
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
								<!-- 	<li><a href="/bahanbakupemilik" class="">Bahan</a></li>
								 -->	<li><a href="/cekproduk" class="">Produk</a></li>
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
<!-- MAIN -->
@foreach($datses as $data)
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-main">
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="Assets1/images/FOTO/{{$data->FOTO}}" style="width: 110px" class="img-circle" alt="Avatar">
										<h3 class="name">{{$data->NAMA}}</h3>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												
											</div>
											<div class="col-md-4 stat-item">
											
											</div>
											<div class="col-md-4 stat-item">
											
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Username <span>{{$data->USERNAME}}</span></li>
											<li>Password <span>{{$data->PASSWORD}}</span></li>
											<li>Alamat <span>{{$data->ALAMAT}}</span></li>
											<li>No Telepon <span>{{$data->NO_TELP}}</span></li>
											<li>Email <span>{{$data->EMAIL}}</span></li>
										</ul>
									</div>
									<!-- <div class="profile-info">
										<h4 class="heading">Social</h4>
										<ul class="list-inline social-icons">
											<li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#" class="github-bg"><i class="fa fa-github"></i></a></li>
										</ul>
									</div> -->
									<!-- <div class="profile-info">
										<h4 class="heading">About</h4>
										<p>Interactively fashion excellent information after distinctive outsourcing.</p>
									</div> -->
									<div class="text-center"><a href="#" data-toggle="modal" data-target="#modal-edit{{Session::get('ID_USER')}}" class="btn btn-primary">Edit Profile</a></div>

									
								</div>
								
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
@endforeach
@php 
      $datprof = DB::table('user')->get();
      @endphp
      @foreach($datprof as $data)  
      <div class="modal fade" id="modal-edit{{$data->ID_USER}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Input</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/editprofile={{$data->ID_USER}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                 	<div class="col-md-6">
	                 	<div class="form-group">
	                    
	                     <label class="col-sm-8 col-sm-8 control-label">Nama :</label>
	                         <input type="text" class="form-control" id="NAMA" name="NAMA" placeholder="Username" value="{{$data->NAMA}}" required="true">
	               
	                  	</div>
	                   	<div class="form-group">
	                    
	                     <label class="col-sm-8 col-sm-8 control-label">Username :</label>
	                         <input type="text" class="form-control" id="USERNAME" name="USERNAME" placeholder="Username" value="{{$data->USERNAME}}" required="true">
	               
	                  	</div>
	                  	<div class="form-group">
	                    
	                     <label class="col-sm-8 col-sm-8 control-label">Password :</label>
	                         <input type="text" class="form-control" id="PASSWORD" name="PASSWORD" placeholder="Password" value="{{$data->PASSWORD}}" required="true">
	               
	                  	</div>
                 	</div>
                 	<div class="col-md-6">
                 		
                 		<div class="form-group">
                    
	                     <label class="col-sm-8 col-sm-8 control-label">Alamat :</label>
	                         <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" placeholder="Username" value="{{$data->ALAMAT}}" required="true">
	               
	                    </div>

	                    <div class="form-group">
	                    
	                     <label class="col-sm-8 col-sm-8 control-label">No Telepon :</label>
	                         <input type="text" class="form-control" id="NO_TELP" name="NO_TELP" placeholder="Username" value="{{$data->NO_TELP}}" required="true">
	               
	                    </div>
	                    <div class="form-group">
	                    
	                     <label class="col-sm-8 col-sm-8 control-label">Email :</label>
	                         <input type="text" class="form-control" id="EMAIL" name="EMAIL" placeholder="Username" value="{{$data->EMAIL}}" required="true">
	               
	                    </div>

                 	</div>
                    <div class="col-md-12" style="text-align: center;">
                     
                    	<div class="form-group">
                    	<label class="control-label">Foto :</label>
                    	<br>
                     	<center>
                     	<input type="file" class="form-control" name="FOTO" style="width: 80%;" value="Assets1/images/FOTO/{{$data->FOTO}}">
                        </center>
                     
                    </div>         
                                          
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
@endforeach

@endsection