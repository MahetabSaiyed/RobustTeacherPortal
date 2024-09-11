<?php
	
	include_once "inc/config.php";

	Auth::$isActive = false;
	if(!Auth::isLogin($con))
	{
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if( isset($_POST['txtUser']) and !empty($_POST['txtUser'])
			and isset($_POST['txtPwd']) and !empty($_POST['txtPwd']) )
			{
				$username = $_POST['txtUser'];
				$password = $_POST['txtPwd'];
				Auth::$isActive = Auth::checkAuth($con, $username, $password);
			}
		}
	}
	else
	{	Auth::$isActive = true;	}

	include_once "inc/header.php";
	
	include_once (Auth::$isActive) ? "dashboard.php" : "login.php";
	
	include_once "inc/footer.php";
	