<?php
	//$chqNo = ""; // Used in fetch_cheque_details.php for searching Cheque Details by Cheque No

	function getConnectionLink()
	{	
		// Returns a MySQL link identifier if the connection is successful or FALSE on failure.
		return mysql_connect('localhost','root','password');
	}

	function getDB()
	{
		$link_host=getConnectionLink();	
		// Returns TRUE on success or FALSE on failure.
		$con_status = mysql_select_db('CHEQUE_MANAGEMENT',$link_host);
		return $con_status;
	}
	
	function validateLogin($user_id,$password)
	{
		$link_host=getConnectionLink();
		$con_status = getDB();
		$sql="select * from `user_master` where `user_id` = '$user_id' and `password` = '$password'";
		$result=mysql_query($sql,$link_host);
		if (!$result || mysql_num_rows($result) < 1){
			// Invalid login
			return FALSE;
		}	
		else{
			// Valid login.
			return TRUE;
		}	
	}
?>