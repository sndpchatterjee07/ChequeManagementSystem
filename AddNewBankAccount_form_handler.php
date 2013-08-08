<html>
<head>
<title>AddNewBankAccount_handler</title>
</head>
<body>
<?php 
   include("DatabaseOperations.php");
   session_start();  // Fetch the Session Values which had been set in login_handler.php
   $session_id=$_SESSION['session_id'];
   $user_id=$_SESSION['user_id'];
   $ifsc_code = $_POST["ifsc_code"];
   $user_account_no = $_POST["user_account_no"];
   $balance = (double)$_POST["balance"];
   $link_host=getConnectionLink();
   $con_status = getDB();
   if($con_status){// Connection to database successful
   			$sql= "INSERT INTO customer_master_list(`user_id`, `user_account_no`, `balance`, `ifsc_code`) VALUES ('$user_id','$user_account_no','$balance','$ifsc_code')";
   			$query_status = mysql_query($sql);
   			if($query_status){
   				$status = "Account Created successfully !";
   				header("Location: AddNewBankForm.php?status=".$status."&&session_id=".$session_id);
   			}
   			else{
   				$status = "Error in processing request !";
   				header("Location: AddNewBankForm.php?status=".$status."&&session_id=".$session_id);
   			}

   }	
   else{// Connection to database failed
   		$status = "Database Error";
   		header("Location: AddNewBankForm.php?status=".$status."&&session_id=".$session_id);
   }

?>
</body>  