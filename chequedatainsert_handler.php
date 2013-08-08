<html>
<head>
<title>ChequeDataInsert_handler</title>
</head>
<body>
<?php
	include("DatabaseOperations.php");
	session_start();  // Fetch the Session Values which had been set in login_handler.php
	$session_id=$_SESSION['session_id'];
	$user_id=$_SESSION['user_id'];
	
	$cheque_no=$_POST["cheque_no"];
	$ifsc_code=$_POST["ifsc_code"];
	$it=$_POST["it"];  // Cheque Issue Date
	$cheque_amount=(double)$_POST["cheque_amount"];  
	$transaction_type = $_POST['transaction_type'];
	$cheque_status=$_POST["cheque_status"]; // Fetched from hidden field,default value is taken(IN PROCESS)
	$issued_to=$_POST["issued_to"];
	$issued_from=$_POST["issued_from"];
	$remarks=$_POST["remarks"];
	$user_account_no=$_POST["user_account_no"];
    $link_host=getConnectionLink();
    $con_status = getDB();
    if($con_status){// Connection to database successful
			$sql= "INSERT INTO cheque_master(`cheque_no`, `ifsc_code`, `cheque_issue_date`, `cheque_amount`, `transaction_type` , `cheque_status`, `issued_to`, `issued_from`, `remarks`,`user_account_no`,`user_id`) VALUES ('$cheque_no','$ifsc_code','$it','$cheque_amount','$transaction_type','$cheque_status','$issued_to','$issued_from','$remarks','$user_account_no','$user_id')";
			$query_status = mysql_query($sql);
			if($query_status){
				$status = "Data inserted successfully !";
				header("Location: ChequeDataInsertForm.php?status=".$status."&&session_id=".$session_id);
			}
			else{
				$status = "Error in processing request !";
				header("Location: ChequeDataInsertForm.php?status=".$status."&&session_id=".$session_id);
			}		
   }
   else{// Connection to database failed
   			$status = "Database Error";
			header("Location: BankDataInsertForm.php?status=".$status."&&session_id=".$session_id);   			
   }
?>
</body>