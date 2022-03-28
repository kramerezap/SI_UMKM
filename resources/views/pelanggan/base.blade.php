<!doctype html>
<html lang="en">
<?php
$sess = Session::get('ID_USER');
$datsess = DB::SELECT("select * from user where ID_USER='$sess'");
?>
<head>
	<title>Pelanggan | Susu Jelly Kediri</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets1/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets1/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets1/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets1/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets1/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets1/css/demo.css">
	<link rel="stylesheet" href="assets1/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets1/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets1/img/favicon.png">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
</head>

<body>
	@foreach($datsess as $data)
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="assets1/img/logo2nobg.jpg" style="width: 139px;margin: -17px -25px -25px 10px" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								
							</a>
							<ul class="dropdown-menu notifications">
									<?php
									$notlev = DB::SELECT("select * from user where STATUS=0 and LEVEL=3 ");
									?>
									@foreach($notlev as $datanot)
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>{{$datanot->USERNAME}} Mendaftar Sebagai @if($datanot->LEVEL==3)
												  Pelanggan
												  @elseif($datanot->LEVEL==4)
												  Pelanggan
												  @endif
													</a></li>
								
						@endforeach
								
							  </ul>
						</li>
						<li class="dropdown">
						<!-- <a href="/keranjang" class="dropdown-toggle icon-menu">
                                <i class="lnr lnr-cart"></i>
                                <?php
                                $ses = Session::GET('ID_USER');
								$con = DB::SELECT("select count(*) as jumlah from det_transaksi where STATUS='3' and ID_USER='$ses' ");
									?>
									@foreach($con as $datajum)
                                <span class="badge bg-danger">{{$datajum->jumlah}}</span>
                                @endforeach
                            </a> -->
                        </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="Assets1/images/FOTO/{{$data->FOTO}}" class="img-circle" alt="Avatar"> <span>{{$data->NAMA}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="/profilepelanggan"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<!-- <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								 --><li><a href="/logoutpelanggan"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		@endforeach
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@section('sidebar')
		@show
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		@section('content')
		@show
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Susu Jelly Kediri <i class="fa fa-love"></i>
</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets1/vendor/jquery/jquery.min.js"></script>
	<script src="assets1/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets1/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets1/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets1/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets1/scripts/klorofil-common.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[23, 29, 24, 40, 25, 24, 35],
				[14, 25, 18, 34, 29, 38, 44],
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);


		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showArea: true,
					showPoint: false,
					showLine: false
				},
			},
			axisX: {
				showGrid: false,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};

		new Chartist.Line('#visits-trends-chart', data, options);


		// visits chart
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[6384, 6342, 5437, 2764, 3958, 5068, 7654]
			]
		};

		options = {
			height: 300,
			axisX: {
				showGrid: false
			},
		};

		new Chartist.Bar('#visits-chart', data, options);


		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
	</script>
	<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
</body>

</html>
