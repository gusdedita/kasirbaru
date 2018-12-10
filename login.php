<?PHP
	error_reporting(0);
	$msg = $_GET['msg'];
	include('configdb.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dayu Alpaka</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
	<link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/fontRoboto.css" rel='stylesheet'>

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

	<!--  CSS select 2 combo box    -->
	<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

	<!--  Autocomplete    -->
	<link href="assets/jquery/aku/jquery-ui.css" rel="stylesheet" />

	<!--Datatables -->
	<link href="assets/css/datatables/dataTables.bootstrap.min.css" rel="stylesheet"></link>

	<!--   Core JS Files   -->
	<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/material.min.js" type="text/javascript"></script>

</head>

<body class="login-page sidebar-collapse">

	<div class="page-header header-filter" style="background-image: url('assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 ml-auto mr-auto">
					<div class="card card-login">

						<form method="post" action="login-autentifikasi.php" enctype="multipart/form-data">
							<div class="card-header card-header-primary text-center">
								<h4 class="card-title">Login</h4>

								<div class="social-line">
									<a href="#pablo" class="btn btn-just-icon btn-link"><i class="fa fa-facebook-square"></i></a>
									<a href="#pablo" class="btn btn-just-icon btn-link"><i class="fa fa-twitter"></i></a>
									<a href="#pablo" class="btn btn-just-icon btn-link"><i class="fa fa-google-plus"></i></a>
								</div>
							</div>
							<p class="description text-center">Dayu Alpaka</p>
							<div class="card-body">

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="material-icons">face</i></span>
									</div>
									<input type="text" class="form-control" name="txt_username" id="txt_username" placeholder="Username...">
								</div>

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="material-icons">lock_outline</i></span>
									</div>
									<input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Password...">
								</div>

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="material-icons">lock_outline</i></span>
									</div>
									<select class="form-control js-example-responsive" id="cb_cabang" name="cb_cabang">
										<?PHP
											$qu_selcabang = "SELECT * FROM cabang WHERE statusdel='N'";
											$sql_selcabang= mysqli_query($conn, $qu_selcabang);
											while($data_selcabang = mysqli_fetch_array($sql_selcabang)){
										?>
												<option value="<?PHP echo $data_selcabang['id_cabang'];?>"><?PHP echo $data_selcabang['nama_cabang'];?></option>
										<?PHP
											}
										?>
									</select>
								</div>
							</div>

							<br></br>
							<div class="footer text-center">
								<button type="submit" class="btn btn-fill btn-primary" name="btn_login" id="btn_login">Login</button>

							</div>
						</form>

					</div>
				</div>
			</div>
		</div>

		<footer class="footer">
			<div class="container">
				<div class="copyright float-right">&copy;
					<a href="https://www.griyaandakasa.com" target="_blank">Develop By</a> GrandLab Industries
				</div>
			</div>
		</footer>

	</div>






</body>






<script src="assets/js/chartist.min.js"></script>
<script src="assets/js/arrive.min.js"></script>
<script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/bootstrap-notify.js"></script>
<script src="assets/js/material-dashboard.js?v=1.2.0"></script>
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        demo.initDashboardPageCharts();
    });
</script>

<!--Autocomplete-->
<script src="assets/jquery/aku/jquery.min.js"></script>
<script src="assets/jquery/aku/jquery-ui.js"></script>






</html>
