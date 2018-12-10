<?PHP
	$getview = $_GET['view'];
?>


<div class="sidebar" data-color="green" data-image="assets/img/sidebar-2.jpg">
            <!--
				Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
				Tip 2: you can also add an image using data-image tag
			-->


            <div class="logo">
                <a href="index.php" class="simple-text">
                    DAYU ALPAKA
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">

                    <li <?PHP if ($getview=="home" || $getview==""){echo "class='active'";}?>>
                        <a href="index.php">
                            <p><i class="fas fa-home"></i> Dashboard</p>
                        </a>
                    </li>

					<li <?PHP if ($getview=="transaction" || $getview=="transaction-data"){echo "class='active'";}?>>
                        <a href="?view=transaction">
                            <p> <i class="fas fa-dollar-sign"></i> Billing</p>
                        </a>
                    </li>

					<li <?PHP if ($getview=="supervisi-data-masalah"){echo "class='active'";}?>>
                        <a href="?view=produk-data">
                            <p><i class="fas fa-sun"></i> Product</p>
                        </a>
                    </li>

                    <li <?PHP if ($getview=="user-data"){echo "class='active'";}?>>
                        <a href="">
							<p><i class="fas fa-file-invoice-dollar"></i> Report</p>
                        </a>
                    </li>

					<li <?PHP if ($getview=="user-data"){echo "class='active'";}?>>
                        <a href="">
                            <p><i class="fas fa-wrench"></i> Setting</p>
                        </a>
                    </li>



                    <li class="active-pro">
                        <a href="index.php">
                            <!--<i class="material-icons">unarchive</i>-->
                            <p><font size="1px">© 2018 Develop By GrandLab Industries<font></p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
