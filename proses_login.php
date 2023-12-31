<?php 
	// session_start();
	include('system/fungsi.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$app = new Core();
	if($app->proses_login($username, md5($password))===TRUE)
	{
		
		header('Location: index.php');
	}else{
		echo "<script>alert('Username atau password salah!')</script>";
		echo "<script>history.back();</script>";
	}
?>