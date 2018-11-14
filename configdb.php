<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbnm = "db_kasir";

	$conn = mysqli_connect ($host, $user, $pass, $dbnm);
	if (mysqli_connect_error()) {
		echo "Server MySQL tidak terhubung".mysqli_connect_error();	
	}
?>