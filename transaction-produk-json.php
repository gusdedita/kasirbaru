<?PHP
	include("configdb.php");
	
	$idproduk = $_POST['idproduk'];
	$qu_selproduk  = "SELECT * FROM produk WHERE id_produk='$idproduk'";
	$sql_selproduk = mysqli_query($conn, $qu_selproduk);
	$data_selproduk = mysqli_fetch_array($sql_selproduk);
		
		$dataproduk[] = array(
			'namaproduk' => $data_selproduk['nama_produk'],
			'harga'		 => $data_selproduk['harga_jual'],
			'stok'		 => $data_selproduk['stok']
		);
		
		echo json_encode($dataproduk);
	//echo "value='".$data_selproduk['nama_produk']."'";
	
?>