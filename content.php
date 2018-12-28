<?php
	if(!defined("INDEX")) die("---");

	$view = isset($_GET['view']) ? $_GET['view'] : "";

	if($view=="login") 									include("login.php");

	elseif($view == "") 								include("home.php");
	elseif($view == "transaction") 						include("transaction.php");
	elseif($view == "transaction-data") 				include("transaction-data.php");
	elseif($view == "transaction-action") 				include("transaction-action.php");

	elseif($view == "user-data") 						include("user-data.php");
	elseif($view == "user-action") 						include("user-action.php");
	
	elseif($view == "produk-data") 						include("produk-data.php");
	elseif($view == "produk-action") 					include("produk-action.php");
	
	elseif($view == "report-kasir") 					include("report-kasir.php");


	else echo"No Content";
?>
