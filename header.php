<?PHP
	include("login-cek.php");
	include("configdb.php");

	$qu_seluser   = "SELECT * FROM user WHERE username='$_SESSION[username_kasiralpaka]' AND password='$_SESSION[password_kasiralpaka]'";
	$sql_seluser  = mysqli_query($conn, $qu_seluser);
	$data_seluser = mysqli_fetch_assoc($sql_seluser);
	$namauser = $data_seluser['nama'];


?>
<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">

		<div class="navbar-header">
            <a class="navbar-brand" href="#"> <b>POINT OF SALE</b></a>
        </div>

		<div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">

                    <a href="#" class="dropdown-toggle btn btn-round btn-white btn-just-icon" data-toggle="dropdown">
						<img class="img-circle img-responsive" src="assets/img/faces/images.jpg" width="50px"/>

						<!--<i class="material-icons">notifications</i>-->
                        <span class="notification"><?PHP echo 0;?></span>
                        <p class="hidden-lg hidden-md">Notifications</p>
                    </a>

                    <ul class="dropdown-menu">
						<li>
                            <a href="?view=user-data">Edit Profile</a>
                        </li>
						<li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

			<form class="navbar-form navbar-right" role="search">
                <div class="form-group  is-empty">
                    <input type="text" class="form-control" style="text-align:right" value="<?PHP echo $namauser;?>" disabled>
                    <span class="material-input"></span>
                </div>
            </form>

		</div>

    </div>
</nav>
