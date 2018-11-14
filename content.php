<?php
	if(!defined("INDEX")) die("---");

	$view = isset($_GET['view']) ? $_GET['view'] : "";

	if($view=="login") 									include("login.php");

	elseif($view == "") 								include("home.php");
	elseif($view == "transaction") 						include("transaction.php");
	elseif($view == "transaction-action") 				include("transaction-action.php");

	elseif($view == "user-data") 				include("user-data.php");


	else echo"No Content";
?>
