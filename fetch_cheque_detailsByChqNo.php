<?php 
	session_start();
	$session_id=$_SESSION['session_id'];
	/*if(($_REQUEST['session_id']=="")||($_REQUEST['session_id']!=$_SESSION['session_id'])){
	 header("location:index.php?status=Session expired.Please login!");
	}*/
	$chqNo=$_POST["chqNo"];
	header('Location: fetch_cheque_details.php?chqNo='.$chqNo.'&session_id='.$session_id);
	
?>
