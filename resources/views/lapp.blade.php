<!DOCTYPE html>
<html>
<head>
	<title>Rekap Pembayaran</title>
	<link rel="stylesheet" href="assets/css/app.min.css">
	<!-- Template CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/components.css">
	<!-- Custom style CSS -->
	<link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h4>Rekap Pembayaran</h4>
	</center>
 	<style type="text/css">
 		table tr td{
 			border: 1px solid black;
 			padding: 5px;
 		}
 	</style>
	
	<table class="table" style="width: 60%;" border="">
		
 	
 	<tbody style="padding-bottom: 20px;">	
				<tr>
				<td style="text-align: center;">No Nota</td>
		      	<td style="text-align: center;">Admin</td>
		      	<td style="text-align: center;">Pemesan</td>
		      	<td style="text-align: center;">Tanggal Pesan</td>
		      	<td style="text-align: center;">Total</td>
		      	<td style="text-align: center;">Bayar</td>
		      	<td style="text-align: center;">Kembali</td>
				</tr>
				@foreach($trans as $tr)
				
				
				<tr style="border: 1px solid #000000;padding-bottom: 10px;">
						
					<td style="width: 53px;text-align: center;">{{$tr->NO_NOTA}}</td>
					<td style="width: 95px;text-align: center;">{{$tr->NAMA}}</td>
					<td style="width: 95px;text-align: center;">{{$tr->NAMA_PEMESAN}}</td>
					<td style="width: 80px;text-align: center;">{{$tr->TGL_PESAN}}</td>
				    <td style="width: 80px;text-align: center;"><?php echo "Rp. ".number_format($tr->TOTAL)." ,-"; ?></td>
				    <td style="width: 80px;text-align: center;"><?php echo "Rp. ".number_format($tr->BAYAR)." ,-"; ?></td>
				    <td style="width: 80px;text-align: center;"><?php echo "Rp. ".number_format($tr->KEMBALI)." ,-"; ?></td>
				</tr>
				
				
		</tbody>
		@endforeach
	</table>
 


  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>

</body>

</html>