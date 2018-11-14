<?PHP
	include("configdb.php");
	
	$notransaksi 	= $_POST['txt_notrans'];
	$tgltransaksi 	= $_POST['txt_tgltrans'];
	$namacust 		= $_POST['txt_namacust'];
	$idproduct 		= $_POST['txt_codeproduct'];
	$hargajual 		= $_POST['txt_harga'];
	$jumlah			= $_POST['txt_jumlah'];
	$subtotal 		= $_POST['txt_subtotal'];
	$total 			= $_POST['txt_totalbayar'];
	$bayar 			= $_POST['txt_jumbayar'];
	$kembali 		= $_POST['txt_kembalian'];
	$carabayar 		= $_POST['rb_paymentmethod'];
	$trfvia 		= $_POST['cb_trfvia'];
	$user 			= $_POST['txt_userlogin'];
	
	if (isset($_POST['btn_addtochart'])){
		
		$qu_insbelanja = "INSERT INTO penjualan_detail 
								(id_produk, quantity, harga_jual, tot_harga, id_user) 
							VALUES 
								('$idproduct', '$jumlah', '$hargajual', '$subtotal', '$user')";
		$sql_insbelanja = mysqli_query($conn, $qu_insbelanja);
		if (mysqli_connect_error()) {
			$msg = "Gagal Insert";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<input type="text" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction">To Transaction</button>
			</form>
			
			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Insert";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<input type="text" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction">To Transaction</button>
			</form>
			
			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		}
	
	} else if (isset($_POST['btn_yes_delbelanja'])){
		$idproduct_bel = $_POST['txt_idprodukbelanja'];
		$iduser_bel	   = $_POST['txt_iduserbelanja'];
		
		$qu_delpro_belanja  = "DELETE FROM penjualan_detail WHERE id_produk='$idproduct_bel' AND id_user='$iduser_bel'";
		$sql_delpro_belanja = mysqli_query($conn, $qu_delpro_belanja);
		if (mysqli_connect_error()) {
			$msg = "Gagal Delete";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<input type="text" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction">To Transaction</button>
			</form>
			
			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Delete";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<input type="text" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction">To Transaction</button>
			</form>
			
			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		}
	} else if (isset($_POST['btn_save']) || isset($_POST['btn_saveprint'])){
		
		$qu_inspenjualan = "INSERT INTO penjualan 
								(id_penjualan, total, bayar, sisa_bayar, jenis_bayar, id_bank, id_customer, id_user, keterangan, statusdel, datecreated)
							VALUES
								('$notransaksi', '$total', '$bayar', '$kembali', '$carabayar', '$trfvia', '$namacust', '$user', '-', 'N', '$tgltransaksi')";
		$sql_inspenjualan= mysqli_query($conn, $qu_inspenjualan);
		
		$qu_updtependet  = "UPDATE penjualan_detail SET id_penjualan='$notransaksi' WHERE id_user='$user' AND id_penjualan IS NULL";
		$sql_updtependet = mysqli_query($conn, $qu_updtependet);
		
		$qu_selpendet = "SELECT pd.id_produk, pd.quantity, p.stok FROM penjualan_detail AS pd JOIN produk AS p ON pd.id_produk=p.id_produk WHERE pd.id_penjualan='$notransaksi'";
		$sql_selpendet = mysqli_query($conn, $qu_selpendet);
		while ($data_selpendet=mysqli_fetch_array($sql_selpendet)){
			$idpro_selpendet = $data_selpendet['id_produk'];
			$sisaproduk = $data_selpendet['stok'] - $data_selpendet['quantity'];
			$qu_updtepro = "UPDATE produk SET stok='$sisaproduk' WHERE id_produk='$idpro_selpendet'";
			$sql_updtepro = mysqli_query($conn, $qu_updtepro);
		}
		
		
		if (mysqli_connect_error()) {
			$msg = "Gagal Insert Penjualan";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<input type="text" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction">To Transaction</button>
			</form>
			
			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Insert Penjualan";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<input type="text" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction">To Transaction</button>
			</form>
			
			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		}
	}
?>