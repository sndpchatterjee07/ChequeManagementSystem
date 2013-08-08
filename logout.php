<?php
	session_start();
	$user_name=$_SESSION['user_name'];
	$session_id=$_SESSION['session_id'];
	//Destroys all data associated with the current session.Does not unset any of the global variables associated with the session.
	session_destroy();
	// Frees all session variables currently registered.
	session_unset();
	// For safety purpose............
	unset($_SESSION['session_id']);
	header("location:index.php");
?>