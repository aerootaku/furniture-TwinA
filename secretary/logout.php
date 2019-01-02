<?php
    require_once '../controller/action.php';
    require_once 'session.php';
	$user_logout = new action($DB_con);
	
//	if($user_logout->is_loggedin()!="")
//	{
//		$user_logout->redirect('dashboard.php');
//	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->logout();
		$user_logout->redirect('../index.php');
	}
