<?php
	$session = new action($DB_con);
	
	if(!$session->is_loggedin())
	{
		// session no set redirects to login page
		$session->redirect('../index.php');
	}