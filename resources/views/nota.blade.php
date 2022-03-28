<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembayaran</title>
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
			<h4 style="margin-left: 160px ;margin-bottom: -7px"> Nota Pembayaran</h4>
			<span style="margin-left: 185px; font-size: 8pt">Susu Jelly Kediri</span>
			<br>
			<span style="margin-left: 35px">---------------------------------------------------------------------</span>
 	<style type="text/css">
 		table tr td{
 			padding: 5px;
 		}
 	</style>
 	<br>
 	<table class="table" style="margin-left: 28px">
 	@foreach($trans as $ts)
 	<tr>
 		<td style="font-size: 8pt">Nota</td>
 		<td style="font-size: 8pt">:</td>
        <td style="font-size: 8pt">{{$ts->NO_NOTA}}</td>
    </tr>
    <tr>
    	<td style="font-size: 8pt">Tanggal</td>
 		<td style="font-size: 8pt">:</td>
        <td style="font-size: 8pt">{{$ts->TGL_PESAN}}</td>
    </tr>
    <tr>
    	<td style="font-size: 8pt">Admin</td>
 		<td style="font-size: 8pt">:</td>
        <td style="font-size: 8pt">{{$ts->NAMA}}</td>
    </tr>
 	@endforeach
	 </table>
 	<span style="margin-left: 35px">---------------------------------------------------------------------</span>
	<table class="table" style="margin-left: 28px">
		@foreach($det as $trs)
		<tr>
			<td>{{$trs->JUMLAH}}</td>
			<td></td>

			<td>{{$trs->NAMA_PRODUK}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>

			<td><?php echo "Rp. ".number_format($trs->HARGA)." ,-"; ?></td>
			<td></td>
			<td></td>
			<td><?php echo "Rp. ".number_format($trs->TOTAL_HARGA)." ,-"; ?></td>
		</tr>
		
		@endforeach
	</table>
	<span style="margin-left: 35px">---------------------------------------------------------------------</span>
	<br>
	<table class="table" style="margin-left: 265px">
	@foreach($tt as $ttt)
	<tr>
		<td>Total </td>
		<td>:</td>
        <td><?php echo "Rp. ".number_format($ttt->TOTAL)." ,-"; ?></td>
    </tr>
    <tr>
        <td>Bayar </td>
		<td>:</td>
        <td><?php echo "Rp. ".number_format($ttt->BAYAR)." ,-"; ?></td>
    </tr>
    <tr>
        <td>Kembali </td>
		<td>:</td>
        <td><?php echo "Rp. ".number_format($ttt->KEMBALI)." ,-"; ?></td>
    </tr>
     @endforeach
    </table>
    <span style="margin-left: 35px">---------------------------------------------------------------------</span>
	<br>
	<span style="margin-left: 110px">Terimakasih Atas Pembelian Anda</span>
	
 <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>

  
</html>