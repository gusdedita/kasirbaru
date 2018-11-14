<?PHP 
	include("configdb.php");
	
	$notrans = $_GET['notrans'];
	$res_seltransdetail = array();
	$no=1;
	
	$qu_ceknotrans = "SELECT * FROM penjualan WHERE id_penjualan='$notrans'";
	$sql_ceknotrans = mysqli_query($conn, $qu_ceknotrans);
	if (mysqli_num_rows($sql_ceknotrans) >= 1){
	
		$qu_seltransdetail = "SELECT 
									* 
								FROM
									penjualan_detail AS pd
									JOIN produk AS P ON pd.id_produk=p.id_produk
								WHERE
									pd.id_penjualan='$notrans'";
	} else {
		$qu_seltransdetail = "SELECT 
									* 
								FROM
									penjualan_detail AS pd
									JOIN produk AS P ON pd.id_produk=p.id_produk
								WHERE
									pd.id_penjualan IS NULL";
	}
	$sql_seltransdetail = mysqli_query($conn, $qu_seltransdetail);
	while($data_seltransdetail=mysqli_fetch_array($sql_seltransdetail)){
			
		$res_seltransdetail[] = array(
				'no'				=> $no,
				'idproduct'			=> $data_seltransdetail['id_produk'],
				'picture'			=> "<img src='assets/img/product/".$data_seltransdetail['picture']."' width='100px'>",
				'product'			=> $data_seltransdetail['nama_produk'],
				'price'				=> $data_seltransdetail['harga_jual'],
				'quantity'			=> $data_seltransdetail['quantity'],
				'subtotal'			=> $data_seltransdetail['tot_harga'],
				'action'			=> "<button class='btn btn-danger' name='btn_delprodet' id='btn_delprodet' style='zoom:60%'>Delete</button>"
			);
		$no++;
	}
	
	$json = json_encode(array('data' => $res_seltransdetail));
	echo $json;
	

?>