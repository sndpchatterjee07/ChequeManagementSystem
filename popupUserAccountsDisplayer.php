<style type="text/css">
<!--
#DisplayWrapper {
	position:absolute;
	width:290px;
	height:90px;
	z-index:1;
	left: 10px;
	top: 10px;
}
#DisplayAccountDetailsTable{
	table-layout:auto;
	width:200px;
	color:#FFFFFF;
	font-size:10px;
	
	
	border: 1px solid #e3e3e3;
	background-color: #BDBDBD;
	border-radius: 6px;
	/*-webkit-border-radius: 6px;
	-moz-border-radius: 6px;*/
}
#DisplayAccountDetailsTable th {
	font-weight:bold;
	padding: 5px;
	color:#FFFFFF;
}
#DisplayAccountDetailsTable td{
 	color:#6E6E6E;
	text-align:right;
 }
-->
</style>
<body background="images/mask_background.jpg">
<div id="DisplayWrapper">
<?php
		//session_start();
		$user_id=$_SESSION['user_id'];
		$session_id=$_SESSION['session_id'];
		//echo $user_id;
		//die; 
		require_once 'DatabaseOperations.php';
		include("ps_pagination.php");
		$link_host=getConnectionLink();
		$con_status = getDB();
		$sql = "SELECT `ifsc_code`,`user_account_no`,`balance` FROM `cheque_management`.`customer_master_list` where `user_id` = '$user_id' ";
		$result=mysql_query($sql,$link_host);
		$num_rows = mysql_num_rows($result);
		//$pagination=new PS_Pagination($link_host,$sql,1,5,"session_id=$session_id");
		//$rs = $pagination->paginate();
		if($result){ // Query returned a resultset
			$fields_num = mysql_num_fields($result); // Column Count
			echo "<table id = DisplayAccountDetailsTable>";
			for($i=0; $i<$fields_num; $i++)
			{
			$field = mysql_fetch_field($result,$i);
			echo '<th>' . strtoupper($field->name) . '</th>';
			}
			echo '</tr>';
			//Loop through the mysql result set
			while($row = mysql_fetch_array($result)) {
			echo '<tr>';
			for ($i = 0; $i<$fields_num; $i++) {
					$field = mysql_fetch_field($result, $i);
					echo '<td>'.$row[$field->name] . '</td>';
			}
			echo '</tr>';
			}
			echo "</table>";
			//echo $pagination->renderFullNav();
			}
			else{  // Query didn't returned any resultset.
				$msg = "No records found !";
			}	
?>
</div>
</body>
