<?php 
	session_start();
	$session_id=$_SESSION['session_id'];
	/*if(($_REQUEST['session_id']=="")||($_REQUEST['session_id']!=$_SESSION['session_id'])){
	 header("location:index.php?status=Session expired.Please login!");
	}*/
	$ifsc_code=$_POST["ifsc_code"];
	header('Location: fetch_bank_details.php?ifsc_code='.$ifsc_code.'&session_id='.$session_id);
	
?>
