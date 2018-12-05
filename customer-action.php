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

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$namacust   = $_POST['txt_namacust'];
	$nohp 	    = $_POST['txt_nohp'];
	$email      = $_POST['txt_email'];
	$alamat     = $_POST['txt_alamat'];
	$keterangan = $_POST['txt_keterangan'];
    $iduser     = $_POST['txt_iduser'];

	if (isset($_POST['btn_savecusttrans'])){

		$qu_incust = "INSERT INTO customer
							(nama_customer, alamat, nohp, email, keterangan, statusdel, id_user, datecreated)
						VALUES
							('$namacust', '$alamat', '$nohp', '$email', '$keterangan', 'N', '$iduser', '$datenow')";
		$sql_incust = mysqli_query($conn, $qu_incust);
		if (mysqli_connect_error()) {
			$msg = "Gagal Insert Customer = ".mysqli_connect_error();
?>
			<form method="post" action="index.php?view=user-data"  enctype="multipart/form-data" >
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_touserdata" id="btn_touserdata" style="display:none">To User Data</button>
			</form>

			<script>
				document.getElementById("btn_touserdata").click();
			</script>
<?PHP
		} else {
			$msg = "Sukses Insert Customer";
?>
			<form method="post" action="index.php?view=user-data"  enctype="multipart/form-data" >
				<div class="loader" style="margin:auto;"></div>
				<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
				<button type="submit" name="btn_touserdata" id="btn_touserdata" style="display:none">To User Data</button>
			</form>

			<script>
				document.getElementById("btn_touserdata").click();
			</script>
<?PHP
		}
	} if (isset($_POST['btn_update'])){


	}
?>
