@extends('admin/base')
@section('sidebar')
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboardadmin" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/valpelangganadm" class=""><i class="lnr lnr-heart"></i> <span>Pelanggan</span></a></li>
						<li><a href="/produk" class=""><i class="lnr lnr-alarm"></i> <span>Produk</span></a></li>
						<li><a href="/transaksi" class=""><i class="lnr lnr-cart"></i> <span>Transaksi</span></a></li>
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
				<h3 class="panel-title">Dashboard</h3>
				<h5>Rating Per Cabang</h5>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10" style="">
						<canvas id="grafik1" width="400" height="170"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	 <script>

            var ctx = document.getElementById('grafik1').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($chrt as $data){ ?>'<?php echo $data->NAMA_CABANG; ?>', <?php }?>],
                    datasets: [{
                        label: 'Transaksi',
                        data: [ 
                                <?php foreach ($chrt as $data){ ?>'<?php echo $data->jmlh; ?>', <?php }?>, 
                              ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    </script>
	</div>
		
@endsection