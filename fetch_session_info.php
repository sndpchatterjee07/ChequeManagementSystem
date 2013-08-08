<?php
		// Code in this PHP page will fetch the session values which had been set in login_handler.php.
		session_start();
		$user_name=$_SESSION['user_name'];
		$session_id=$_SESSION['session_id'];
		if(($_REQUEST['session_id']=="")||($_REQUEST['session_id']!=$_SESSION['session_id'])) header("location:index.php?status=Session expired.Please login!");
		if(http_build_query($_GET, '', '|') != "") echo 'Welcome '.'<span style="font-family: Verdana; color: #6E6E6E;font-size: 12px; font-weight:bold">'.$user_name.'</span>';
?>
