<html>
<head>
<title>CMS: Avaiilable Branches</title>
<style type="text/css">
<!--
#bd1{
	/* background-image:url("../images/background.jpg"); */
	background-image: url("images/background.jpg");
}
#FormWrapper {
	position:absolute;
 	width:240px;
 	height:90px;
 	z-index:1; 
 	left: 10px;
 	top: 10px; 
  /* background-color: green; */
}
#DisplayTable{
	table-layout:auto;
	width:440px;
	height: 100%;
	color:#FFFFFF;
	font-size:10px;
	
	
	border: 1px solid #e3e3e3;
	background-color: #FF9900;
	border-radius: 6px;
	/*-webkit-border-radius: 6px;
	-moz-border-radius: 6px;*/
}
#DisplayTable th {
	font-weight:bold;
	/* padding: 5px; */
	color:#6E6E6E;
	text-align:right;
}
#DisplayTable td{
 	color:#FFFFFF;
	text-align:right;
/* 	font-weight: bold; */
	
}
.button
{
    background: #3BB9FF url("images/overlay.png") repeat-x;
    /*padding: 8px 10px 8px;*/
    color: #fff;
    text-decoration: none;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
    cursor: pointer;
    float:right;
    font-size:10px;
    /*margin:10px;*/
}
-->
</style>
<script type="text/javascript">
   function SetValueInParent(x)
   {
         window.opener.document.AddNewBankAccount_form.ifsc_code.value = x;
         window.close();
         return true;
    }

    function validator(){
    	var frm = document.f1;
    	var status = f1['ifsc_code'];
    	var x = "";
      	for (i=0; i < status.length; i++ ) {
    		if (status[i].checked ) {
    			x= status[i].value;
    		}
     	}
     	if(x==""){
   			alert("Please select your Bank Code !");
    		return false;
     	}	
     	return true;
    }
</script>
</head>
<body id="bd1">
<div id="FormWrapper">
<form name="f1" method="post" action="AddNewBankForm.php" onsubmit="return validator();">
<?php 
		session_start();
		$user_id=$_SESSION['user_id'];
		$session_id=$_SESSION['session_id'];
		require_once 'DatabaseOperations.php';
		include("ps_pagination.php");
		$link_host=getConnectionLink();
		$con_status = getDB();
		$sql = "SELECT `ifsc_code`,`branch_name` FROM `cheque_management`.`bank_master`";
		$result=mysql_query($sql,$link_host);
		/* $num_rows = mysql_num_rows($result); */
		$pagination=new PS_Pagination($link_host,$sql,2,5,"session_id=$session_id");
		$rs = $pagination->paginate();
		if($rs){ // Query returned a resultset
			$fields_num = mysql_num_fields($result); // Column Count
			echo "<table id = DisplayTable>";
			for($i=0; $i<$fields_num; $i++)
			{
			$field = mysql_fetch_field($result,$i);
			echo '<th></th>';
			echo '<th>' . strtoupper($field->name) . '</th>';
			}
					echo '</tr>';
			//Loop through the mysql result set
			while($row = mysql_fetch_array($rs)) {
			echo '<tr>';
			echo '<td><input type="radio" id="ifsc_code" name="ifsc_code" value='.$row[0].'></td>';
			for ($i = 0; $i<$fields_num; $i++) {
			$field = mysql_fetch_field($result, $i);
				echo '<td>'.$row[$field->name] . '</td>';
			}
			echo '</tr>';
			}
			echo "</table>";
				echo $pagination->renderFullNav();
		}
		else{  // Query didn't returned any resultset.
			$msg = "No records found !";
			echo '<script language="javascript">alert("No Records found !"); return false;</script>';
		}
?>
<!-- <p align="right"><button class="button">Go ! &raquo;</button></p>  -->
<input id="btn1" class="button" type="submit" value="Go !"  onclick="var frm = document.f1;
	var status = f1['ifsc_code'];for ( i = 0; i < status.length; i++ ) {
		if ( status[i].checked ) {
			var x= status[i].value;
			javascript:SetValueInParent(x);
		}
	}"  />
</form>
</div>
</body>
</html>