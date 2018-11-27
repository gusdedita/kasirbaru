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
	
	$iduser	  = $_POST['txt_iduser'];
	$nama 	  = $_POST['txt_nama'];
	$username = $_POST['txt_username'];
	$password = $_POST['txt_password'];
	$nohp     = $_POST['txt_nohp'];
	$email    = $_POST['txt_email'];
	$otoritas = $_POST['cb_otoritas'];
	$picture  = $_FILES['inp_picture']['name'];
	
	if (isset($_POST['btn_save'])){
		
		if (strlen($picture)>0) {
			if (is_uploaded_file($_FILES['inp_picture']['tmp_name'])) {
				move_uploaded_file($_FILES['inp_picture']['tmp_name'], "assets/img/user/".$picture);
			}
		}
		
		$qu_inuser = "INSERT INTO user 
							(nama, username, password, email, nohp, picture, otoritas, status_del, datecreated)
						VALUES
							('$nama', '$username', '$password', '$email', '$nohp', '$picture', '$otoritas', 'N', '$datenow')";
		$sql_inuser = mysqli_query($conn, $qu_inuser);
		if (mysqli_connect_error()) {
			$msg = "Gagal Insert".mysqli_connect_error();
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
			$msg = "Sukses Insert";
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
		
		if (strlen($picture)>0) {
			if (is_uploaded_file($_FILES['inp_picture']['tmp_name'])) {
				move_uploaded_file($_FILES['inp_picture']['tmp_name'], "assets/img/user/".$picture);
			}
		}
		
		if ($picture == ""){
			$qu_upuser = "UPDATE user SET 
							nama = '$nama',
							username = '$username',
							password = '$password',
							email = '$email',
							nohp = '$nohp'
						WHERE
							id_user = '$iduser'";
		} else {
			$qu_upuser = "UPDATE user SET 
							nama = '$nama',
							username = '$username',
							password = '$password',
							email = '$email',
							nohp = '$nohp',
							picture = '$picture'
						WHERE
							id_user = '$iduser'";
		}
		
		$sql_upuser = mysqli_query($conn, $qu_upuser);
		if (mysqli_connect_error()) {
			$msg = "Gagal Update".mysqli_connect_error();
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
			$msg = "Sukses Update";
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
	}
?>


