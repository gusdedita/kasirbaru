<?php
include("configdb.php");

session_start();

//tangkap data dari form login
$username = $_POST['txt_username'];
$password = $_POST['txt_password'];

//untuk mencegah sql injection
//kita gunakan mysql_real_escape_string
//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);

//cek data yang dikirim, apakah kosong atau tidak
if (empty($username) && empty($password)) {
	//kalau username dan password kosong
	header('location:login.php?msg=emp');
	break;
} else if (empty($username)) {
	//kalau username saja yang kosong
	header('location:login.php?msg=usr-emp');
	break;
} else if (empty($password)) {
	//kalau password saja yang kosong
	header('location:login.php?msg=psr-emp');
	break;
}

$qu_user  = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$sql_user = mysqli_query($conn, $qu_user)or die(mysqli_error());

if (mysqli_num_rows($sql_user)==1) {
	//kalau username dan password sudah terdaftar di database
	//buat session dengan nama username dengan isi nama user yang login
	$_SESSION['username_kasiralpaka'] = $username;
	$_SESSION['password_kasiralpaka'] = $password;
	header('location:index.php?msg=log-suc');
} else {
	header('location:login.php?msg=log-fail');
	break;
}
?>