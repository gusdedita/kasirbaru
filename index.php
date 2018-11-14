<?PHP
	define("INDEX",true);
	//error_reporting(0);
	session_start();
	ob_start();
	define('DEF',true);
	include("configdb.php");
	include("login-cek.php")
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>POS DAYU ALPAKA</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	
	<!--   Core JS Files   -->
	<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/material.min.js" type="text/javascript"></script>
	
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
	<!--<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />-->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/fontRoboto.css" rel='stylesheet'>
	
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	
	<!--  CSS select 2 combo box    -->
	<!--<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>-->
	<!--<link href="assets/select2/dist/css/select2material.css" rel="stylesheet" type="text/css"/>-->
	<link href="assets/css/select2-materialize.css" type="text/css" rel="stylesheet" >
	
	<!--Datatables-->
	<link href="assets/css/datatables/dataTables.bootstrap.min.css" rel="stylesheet"></link>
	
	<!--Datatables-->
	<!--<script src="assets/js/datatables/jquery.min.js"></script>-->
	<!--<script src="assets/js/datatables/bootstrap.min.js" type="text/javascript"></script>-->
	<script src="assets/js/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatables/dataTables.bootstrap.min.js"></script>
		
	<!--<script src="assets/select2/dist/jquery-2.1.4.min.js"></script>-->
	<script src="assets/select2/dist/js/select2.min.js"></script>
	
	<!--Moment-->
	<script src="assets/moment/moment.js"></script>
	
	<!--  Autocomplete    -->
	<!--<link href="assets/jquery/aku/jquery-ui.css" rel="stylesheet" />-->
	<link rel="stylesheet" href="assets/autocomplete/jquery-ui.css" />
    <!--<script src="assets/autocomplete/jquery-1.8.3.js"></script>-->
    <script src="assets/autocomplete/jquery-ui.js"></script>
	
	
</head>

<body>
    <div class="wrapper">
	
	<?PHP
		include('sidebar.php');
	?>
        
        <div class="main-panel">
            
			<?PHP
				include('header.php');
			?>
			
            <?PHP
				include('content.php');
			?>
            
			<?PHP
				//include('footer.php');
			?>
        </div>
    </div>
	
</body>






<script src="assets/js/chartist.min.js"></script>
<script src="assets/js/arrive.min.js"></script>
<script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/bootstrap-notify.js"></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<script src="assets/js/material-dashboard.js?v=1.2.0"></script>
<script src="assets/js/demo.js"></script>



<!--Autocomplete
<script src="assets/jquery/aku/jquery.min.js"></script>
<script src="assets/jquery/aku/jquery-ui.js"></script>-->







</html>