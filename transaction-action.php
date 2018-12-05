<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
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
	$idcabang		= $_POST['txt_idcabang'];

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
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction" style="display:none">To Transaction</button>
			</form>

			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Insert";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction" style="display:none">To Transaction</button>
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
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction" style="display:none">To Transaction</button>
			</form>

			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Delete";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction" style="display:none">To Transaction</button>
			</form>

			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		}
	} else if (isset($_POST['btn_save']) || isset($_POST['btn_saveprint'])){

		$qu_inspenjualan = "INSERT INTO penjualan
								(id_penjualan, total, bayar, sisa_bayar, jenis_bayar, id_bank, id_customer, id_user, id_cabang, keterangan, statusdel, datecreated)
							VALUES
								('$notransaksi', '$total', '$bayar', '$kembali', '$carabayar', '$trfvia', '$namacust', '$user', '$idcabang', '-', 'N', '$tgltransaksi')";
		$sql_inspenjualan= mysqli_query($conn, $qu_inspenjualan);

		$qu_updtependet  = "UPDATE penjualan_detail SET id_penjualan='$notransaksi' WHERE id_user='$user' AND id_penjualan IS NULL";
		$sql_updtependet = mysqli_query($conn, $qu_updtependet);

		//update stok
		$qu_selpendet = "SELECT
							pd.id_produk,
							pd.quantity,
							p.stok AS stok_tot,
							sc.stok AS stok_cabang
						FROM
							penjualan_detail AS pd
							JOIN produk AS p ON pd.id_produk=p.id_produk
							JOIN stok_cabang AS sc ON pd.id_produk=sc.id_produk
						WHERE
							pd.id_penjualan='$notransaksi'
							AND sc.id_cabang='$idcabang'";
		$sql_selpendet = mysqli_query($conn, $qu_selpendet);
		while ($data_selpendet=mysqli_fetch_array($sql_selpendet)){
			$idpro_selpendet = $data_selpendet['id_produk'];
			$sisaproduk_tot    = $data_selpendet['stok_tot'] - $data_selpendet['quantity'];
			$sisaproduk_cabang = $data_selpendet['stok_cabang'] - $data_selpendet['quantity'];

			$qu_updtepro = "UPDATE produk SET stok='$sisaproduk_tot' WHERE id_produk='$idpro_selpendet'";
			$sql_updtepro = mysqli_query($conn, $qu_updtepro);

			$qu_updtestokcabang = "UPDATE stok_cabang SET stok='$sisaproduk_cabang' WHERE id_cabang='$idcabang' AND id_produk='$idpro_selpendet'";
			$sql_updtestokcabang = mysqli_query($conn, $qu_updtestokcabang);
		}

		if (mysqli_connect_error()) {
			$msg = "Gagal Insert Penjualan";
?>
			<form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction" style="display:none">To Transaction</button>
			</form>

			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Insert Penjualan";

			if (isset($_POST['btn_saveprint'])){
?>
                <script>window.open('http://localhost/kasirbaru/transaction-print.php?idpenjualan=<?PHP echo $notransaksi;?>');</script>
<?php
            }
?>
            <form method="post" action="index.php?view=transaction"  enctype="multipart/form-data" >
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_totransaction" id="btn_totransaction" style="display:none">To Transaction</button>
			</form>

			<script>
				document.getElementById("btn_totransaction").click();
			</script>
<?PHP
		}
	}
?>
