<?php
	session_start();
	$session_id=$_SESSION['session_id'];
	/*if(($_REQUEST['session_id']=="")||($_REQUEST['session_id']!=$_SESSION['session_id'])){
	 header("location:index.php?status=Session expired.Please login!");
	}*/
	$companyId=$_POST["companyId"];
	header('Location: fetch_sundry_details.php?companyId='.$companyId.'&session_id='.$session_id);
?>