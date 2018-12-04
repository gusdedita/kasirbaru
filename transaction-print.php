<?PHP
	
	include('configdb.php');
	
	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');
	
	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
	}
	
	$get_idpenjualan = $_GET['idpenjualan'];
		
	$qu_selpenjualan   = "SELECT * FROM penjualan WHERE id_penjualan='$get_idpenjualan' AND statusdel='N'";
	$sql_selpenjualan  = mysqli_query($conn, $qu_selpenjualan);
	$data_selpenjualan = mysqli_fetch_assoc($sql_selpenjualan);
	

	
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>POS DAYU ALPAKA</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	
	<!--     Fonts and icons     -->
	<link href="assets/css/fontawesome/css/all.css" rel="stylesheet">
	<link href="assets/css/fontawesome/css/all.min.css" rel="stylesheet">
	<script src="assets/css/fontawesome/js/all.js"></script>
	<script src="assets/css/fontawesome/js/all.min.js"></script>
	
</head>

<body>
	<p align="center">
		<img src="assets/img/logo-hitam.png" width="100px">
		<br>DAYU ALPAKA JEWELERY
		<br>Supplier Alapaka Bali
	</p>
	<table align="center">
		<tr>
			<td colspan="4"><hr></hr></td>
		</tr>
		<?PHP 
			$tot_quantity = 0;
			$qu_selpendet = "SELECT * FROM penjualan_detail AS pd JOIN produk AS p ON pd.id_produk=p.id_produk WHERE pd.id_penjualan='$get_idpenjualan'";
			$sql_selpendet = mysqli_query($conn, $qu_selpendet);
			while($data_selpendet=mysqli_fetch_array($sql_selpendet)){
				$tot_quantity = $tot_quantity + $data_selpendet['quantity'];
		?>
		<tr>
			<td><?PHP echo $data_selpendet['nama_produk'];?></td>
			<td align="right">| <?PHP echo rupiah($data_selpendet['harga_jual']);?></td>
			<td align="center">| x <?PHP echo $data_selpendet['quantity'];?></td>
			<td align="right">| <?PHP echo rupiah($data_selpendet['tot_harga']);?></td>
		</tr>
		<?PHP
			}
		?>
		<tr>
			<td colspan="4"><hr></hr></td>
		</tr>
		<tr>
			<td colspan="2" align="right">Total : </td>
			<td align="center"><?PHP echo $tot_quantity;?></td>
			<td align="right"><?PHP echo rupiah($data_selpenjualan['total']);?></td>
		</tr>
		<tr>
			<td colspan="2" align="right">Pembayaran : </td>
			<td colspan="2" align="right"><?PHP echo rupiah($data_selpenjualan['bayar']);?></td>
		</tr>
		<tr>
			<td colspan="2" align="right">Sisa Pembayaran : </td>
			<td colspan="2" align="right"><?PHP echo rupiah($data_selpenjualan['sisa_bayar']);?></td>
		</tr>
		<tr>
			<td colspan="4"><hr></hr></td>
		</tr>
	</table>
	<p align="center">
		Terimakasih, Silakan Berbelanja Kembali
		<br>
		= Follow Social Media Kami = 
	</p>
	<table align="center">
		<tr>
			<td><img src="assets/img/instagram.png" width="20px"></td>
			<td>@dayu_alpaka</td>
		</tr>
		<tr>
			<td><img src="assets/img/whatsapp.png" width="20px"></td>
			<td>081805400516</td>
		</tr>
		<tr>
			<td><img src="assets/img/line.png" width="20px"></td>
			<td>yugegmini</td>
		</tr>
	</table>
</body>