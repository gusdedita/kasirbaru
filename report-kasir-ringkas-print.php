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
	
	$get_idcabang = $_GET['idcab'];
	$get_tglstart = $_GET['tglstart'];
	$get_tglend   = $_GET['tglend'];
	
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
	
	<style>
		table {
		  border-collapse: collapse;
		}

		table, td, th {
		  border: 1px solid black;
		}
	</style>
	
</head>

<body>
	<table align="center" style="border:0px" >
		<tr style="border:0px">
			<th style="border:0px" rowspan="2"><a href="index.php"><img src="assets/img/logo-hitam.png" width="100px"></a></th>
			<th style="border:0px; vertical-align:bottom;" align="left">LAPORAN RINGKAS HARIAN KASIR</th>
		</tr>
		<tr style="border:0px">
			<td style="border:0px; vertical-align:top;" align="left">Tanggal Laporan <?PHP echo $get_tglstart;?> s/d <?PHP echo $get_tglend;?></td>
		</tr>
		
	</table>

	
	<table align="center" >
		<tr>
			<td align="center"><b>No</b></td>
			<td align="center"><b>No. Trans.</b></td>
			<td align="center"><b>Tgl. Trans.</b></td>
			<td><b>Member</b></td>
			<td align="center"><b>Jenis Pembayaran</b></td>
			<td align="center"><b>Jumlah Produk</b></td>
			<td align="center"><b>Total Bayar</b></td>
		</tr>

		<tbody>
			<?PHP
				$no_selpenjualan  = 1;
				$total = 0;
				$total_quantity = 0;
				
				$qu_selpenjualan  = "SELECT 
										p.id_penjualan,
										p.datecreated,
										c.nama_customer,
										p.jenis_bayar,
										p.total
									FROM 
										penjualan AS p
										LEFT JOIN customer AS c ON p.id_customer=c.id_customer
									WHERE 
										(p.datecreated BETWEEN '$get_tglstart' AND '$get_tglend') 
										AND p.dateclose ='$datenow'
										AND id_cabang='$get_idcabang'";
				$sql_selpenjualan = mysqli_query($conn, $qu_selpenjualan);
				while($data_selpenjualan = mysqli_fetch_array($sql_selpenjualan)){
					$total = $total + $data_selpenjualan['total'];
					$idpenjualan = $data_selpenjualan['id_penjualan'];
				
					$qu_seljumproduk = "SELECT SUM(quantity) AS JUMPRO FROM penjualan_detail WHERE id_penjualan='$idpenjualan'";
					$sql_seljumproduk = mysqli_query($conn, $qu_seljumproduk);
					$data_seljumproduk = mysqli_fetch_assoc($sql_seljumproduk);
				
					$total_quantity = $total_quantity + $data_seljumproduk['JUMPRO'];
			?>
					<tr>
						<td align="center"><?PHP echo $no_selpenjualan;?></td>
						<td align="center"><?PHP echo $data_selpenjualan['id_penjualan'];?></td>
						<td align="center"><?PHP echo $data_selpenjualan['datecreated'];?></td>
						<td><?PHP if ($data_selpenjualan['nama_customer']==""){echo " - ";} else {echo $data_selpenjualan['nama_customer'];}?></td>
						<td align="center"><?PHP echo $data_selpenjualan['jenis_bayar'];?></td>
						<td align="center"><?PHP echo $data_seljumproduk['JUMPRO'];?></td>
						<td align="right"><?PHP echo rupiah($data_selpenjualan['total']);?></td>
					</tr>

			<?PHP
					$no_selpenjualan++;
				}
			?>
			
			<tr>
				<td colspan="5" align="right"><b>Total Penjualan</b></td>
				<td align="center"><?PHP echo $total_quantity;?> Pcs Produk</td>
				<td align="right"><?PHP echo rupiah($total);?></td>
			</tr>
			
		</tbody>

	</table>
	
	
</body>