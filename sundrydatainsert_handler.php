<html>
<head>
<title>SundryDataInsert_handler</title>
</head>
<body>
<?php 
   include("DatabaseOperations.php");
   session_start();  // Fetch the Session Values which had been set in login_handler.php
   $session_id=$_SESSION['session_id'];
   $user_id=$_SESSION['user_id'];
   $company_id = $_POST["company_id"];
   $company_name = $_POST["company_name"];
   $whether_debitor = $_POST["whether_debitor"];
   $whether_creditor = $_POST["whether_creditor"];
   $responsible_person = $_POST["responsible_person"];
   $responsible_person_address = $_POST["responsible_person_address"];
   $responsible_person_contact_no = $_POST["responsible_person_contact_no"];
   $link_host=getConnectionLink();
   $con_status = getDB();
   if($con_status){// Connection to database successful
   	 $sql= "INSERT INTO sundry_info_master(`company_id`, `company_name`, `whether_debitor`, `whether_creditor`, `responsible_person`, `responsible_person_address`, `responsible_person_no`, `user_id`) VALUES ('$company_id','$company_name','$whether_debitor','$whether_creditor','$responsible_person','$responsible_person_address','$responsible_person_contact_no','$user_id')";
	 $query_status = mysql_query($sql);
	 if($query_status){
		$status = "Data inserted successfully !";
		header("Location: SundryDataInsertForm.php?status=".$status."&&session_id=".$session_id);
		}
		else{
				$status = "Error in processing request !";
				header("Location: SundryDataInsertForm.php?status=".$status."&&session_id=".$session_id);
			}		
   }
   else{// Connection to database failed
   			$status = "Database Error";
			header("Location: SundryDataInsertForm.php?status=".$status."&&session_id=".$session_id);   			
   }
?>
</body>