<html>
<head>
<title>BankDataInsert_handler</title>
</head>
<body>
<?php 
include("DatabaseOperations.php");
   session_start();  // Fetch the Session Values which had been set in login_handler.php
   $session_id=$_SESSION['session_id'];
	
   $bank_code = $_POST["bank_code"];
   $bank_name = $_POST["bank_name"];
   $bank_address = $_POST["bank_address"];
   $bank_contactno = $_POST["bank_contactno"];

   $link_host=getConnectionLink();
   $con_status = getDB();
   if($con_status){// Connection to database successful

			$sql= "INSERT INTO bank_master(`bank_code`, `bank_name`, `bank_address`, `bank_contactno`) VALUES ('$bank_code','$bank_name','$bank_address','$bank_contactno')";

			$query_status = mysql_query($sql);
			if($query_status){
				$status = "Data inserted successfully !";
				header("Location: BankDataInsertForm.php?status=".$status."&&session_id=".$session_id);
			}
			else{
				$status = "Error in processing request !";
				header("Location: BankDataInsertForm.php?status=".$status."&&session_id=".$session_id);
			}		
   }
   else{// Connection to database failed
   			$status = "Database Error";
			header("Location: BankDataInsertForm.php?status=".$status."&&session_id=".$session_id);   			
   }

?>
</body>