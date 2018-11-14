<?PHP
if (!isset($_SESSION['username_kasiralpaka']) || empty($_SESSION['username_kasiralpaka'])) {
	header("location:login.php");
}
?>  