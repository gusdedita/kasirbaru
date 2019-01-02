<?PHP
	include("configdb.php");

	date_default_timezone_set('Asia/Singapore');
	$datenow  = date('Y-m-d');
	$datecode = date('dmY');
	$timecode = date('h:i:s');

	$idpro 		= $_POST['txt_idpro'];
	$namapro 	= $_POST['txt_namapro'];
	$hargabeli 	= $_POST['txt_hargabeli'];
	$hargajual 	= $_POST['txt_hargajual'];
	$kategori 	= $_POST['cb_kategori'];
	$keterangan = $_POST['txt_keterangan'];
	$picture 	= $_FILES['inp_picture']['name'];
	$iduser 	= $_POST['txt_iduser'];

	$qu_selcabang = "SELECT * FROM cabang WHERE statusdel='N'";
	$sql_selcabang=mysqli_query($conn, $qu_selcabang);
	while($data_selcabang=mysqli_fetch_array($sql_selcabang)){
		${'stok'.$data_selcabang['nama_cabang']} = $_POST['txt_stok_'.$data_selcabang['nama_cabang']];
	}

	if (isset($_POST['btn_save'])){

		$totstok = 0;
		$qu_selcabang2 = "SELECT * FROM cabang WHERE statusdel='N'";
		$sql_selcabang2=mysqli_query($conn, $qu_selcabang2);
		while($data_selcabang2=mysqli_fetch_array($sql_selcabang2)) {
			$idcabang = $data_selcabang2['id_cabang'];
			$stokcabang = ${'stok'.$data_selcabang2['nama_cabang']};

			$qu_ins_stokcabang = "INSERT INTO stok_cabang (id_cabang, id_produk, stok) VALUES ('$idcabang', '$idpro', '$stokcabang')";
			$sql_ins_stokcabang = mysqli_query($conn, $qu_ins_stokcabang);

			$totstok = $totstok + $stokcabang;
		}

		if (strlen($picture)>0) {
			if (is_uploaded_file($_FILES['inp_picture']['tmp_name'])) {
				move_uploaded_file($_FILES['inp_picture']['tmp_name'], "assets/img/product/".$picture);
			}
		}

		$qu_ins_produk = "INSERT INTO produk
							(id_produk, nama_produk, harga_beli, harga_jual, stok, picture, keterangan, id_kategori, id_user, statusdel, datecreated)
						VALUES
							('$idpro', '$namapro', '$hargabeli', '$hargajual', '$totstok', '$picture', '$keterangan', '$kategori', '$iduser', 'N', '$datenow')";
		$sql_ins_produk = mysqli_query($conn, $qu_ins_produk);

		if (mysqli_connect_error()) {
			$msg = "in-failed";
		} else {
			$msg = "in-success";
        }
?>
		<form method="post" action="index.php?view=produk-data"  enctype="multipart/form-data" >
			<div class="loader" style="margin:auto;"></div>
			<input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
			<button type="submit" name="btn_action" id="btn_action" style="display:none">Action</button>
		</form>

		<script>
			document.getElementById("btn_action").click();
		</script>
<?PHP

	} else if (isset($_POST['btn_update'])){

		$totstok_edit = 0;
		$qu_selcabang_edit  = "SELECT * FROM cabang WHERE statusdel='N'";
		$sql_selcabang_edit = mysqli_query($conn, $qu_selcabang_edit);
		while($data_selcabang_edit = mysqli_fetch_array($sql_selcabang_edit)) {
			$idcabang_edit = $data_selcabang_edit['id_cabang'];
			$stokcabang_edit = ${'stok'.$data_selcabang_edit['nama_cabang']};

			$qu_upd_stokcabang  = "UPDATE stok_cabang SET stok='$stokcabang_edit' WHERE id_cabang='$idcabang_edit' AND id_produk='$idpro'";
			$sql_upd_stokcabang = mysqli_query($conn, $qu_upd_stokcabang);

			$totstok_edit = $totstok_edit + $stokcabang_edit;
		}

		if (strlen($picture)>0) {
			if (is_uploaded_file($_FILES['inp_picture']['tmp_name'])) {
				move_uploaded_file($_FILES['inp_picture']['tmp_name'], "assets/img/product/".$picture);
			}

			$qu_upd_produk = "UPDATE produk SET
								nama_produk	='$namapro',
								harga_beli	='$hargabeli',
								harga_jual	='$hargajual',
								stok		='$totstok_edit',
								picture		='$picture',
								keterangan	='$keterangan',
								id_kategori	='$kategori',
								id_user		='$iduser',
								dateupdated	='$datenow'
							WHERE
								id_produk='$idpro'";
		} else {
			$qu_upd_produk = "UPDATE produk SET
								nama_produk	='$namapro',
								harga_beli	='$hargabeli',
								harga_jual	='$hargajual',
								stok		='$totstok_edit',
								keterangan	='$keterangan',
								id_kategori	='$kategori',
								id_user		='$iduser',
								dateupdated	='$datenow'
							WHERE
								id_produk = '$idpro'";
		}
		$sql_upd_produk = mysqli_query($conn, $qu_upd_produk);

		if (mysqli_connect_error()) {
			$msg = "up-failed";
		} else {
			$msg = "up-success";
        }
?>
        <form method="post" action="index.php?view=produk-data"  enctype="multipart/form-data" >
            <div class="loader" style="margin:auto;"></div>
            <input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
            <button type="submit" name="btn_action" id="btn_action" style="display:none">Action</button>
        </form>

        <script>
            document.getElementById("btn_action").click();
        </script>
<?PHP
    } else if (isset($_POST['btn_delpro'])){

        $qu_delpro  = "UPDATE produk SET statusdel='Y' WHERE id_produk='$idpro'";
        $sql_delpro = mysqli_query($conn, $qu_delpro);

        if (mysqli_connect_error()) {
			$msg = "del-failed";
		} else {
			$msg = "del-success";
        }
?>
        <form method="post" action="index.php?view=produk-data"  enctype="multipart/form-data" >
            <div class="loader" style="margin:auto;"></div>
            <input type="hidden" id="txt_msg" name="txt_msg" value="<?PHP echo $msg;?>">
            <button type="submit" name="btn_action" id="btn_action" style="display:none">Action</button>
        </form>

        <script>
            document.getElementById("btn_action").click();
        </script>
<?php
    }
?>
