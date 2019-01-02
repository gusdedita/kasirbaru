<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');
	$datetime = date('Y-m-d h:i:s');
	
	$idcabang = $_POST['txt_idcabang'];
	$iduser   = $_POST['txt_userlogin'];
	$tglstart = $_POST['txt_tglstart'];
	$tglend   = $_POST['txt_tglend'];
	$jumfisik = $_POST['txt_jumfisik'];
	$jumtrf   = $_POST['txt_jumtrf'];
	$jumtot   = $_POST['txt_jumtot'];
	$catatan  = $_POST['txt_catatanclose'];
	
	if (isset($_POST['btn_saveprint'])){
		
		$qu_inreport = "INSERT INTO report_closing 
						(datecreated, id_cabang, id_user, tgl_start, tgl_end, jum_fisik, jum_trf, jum_tot, catatan)
						VALUES 
						('$datetime', '$idcabang', '$iduser', '$tglstart', '$tglend', '$jumfisik', '$jumtrf', '$jumtot', '$catatan')";
		$sql_inreport = mysqli_query($conn, $qu_inreport);
		
		$qu_uppenjualan = "UPDATE 
								penjualan
							SET
								dateclose='$datenow'
							WHERE 
								(datecreated BETWEEN '$tglstart' AND '$tglend') 
								AND dateclose IS NULL
								AND id_cabang='3'";
		$sql_uppenjualan = mysqli_query($conn, $qu_uppenjualan);
		
		if (mysqli_connect_error()) {
			$msg = "report-failed";
		} else {
			$msg = "report-success";
        }
?>
		<form method="post" action="report-kasir-ringkas-print.php?idcab=<?PHP echo $idcabang;?>&tglstart=<?PHP echo $tglstart;?>&tglend=<?PHP echo $tglend;?>"  enctype="multipart/form-data" >
			<div class="loader" style="margin:auto;"></div>
			<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
			<button type="submit" name="btn_action" id="btn_action" style="display:none">Action</button>
		</form>

		<script>
			document.getElementById("btn_action").click();
		</script>
<?PHP
	}
?>