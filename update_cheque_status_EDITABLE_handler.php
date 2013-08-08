<?php
include("DatabaseOperations.php");
session_start();  // Fetch the Session Values which had been set in login_handler.php
$session_id=$_SESSION['session_id'];
$user_id=$_SESSION['user_id'];

$cheque_no=$_POST["cheque_no"];
$ifsc_code=$_POST["ifsc_code"];
$it=$_POST["it"];
$cheque_amount=$_POST["cheque_amount"];
$transaction_type=$_POST["transaction_type"];
$cheque_status=$_POST["cheque_status"];
$issued_to=$_POST["issued_to"];
$issued_from=$_POST["issued_from"];
$remarks=$_POST["remarks"];

/* echo "Cheque No.: ".$cheque_no."<br/>";
echo "IFSC Code : ".$ifsc_code."<br/>";
echo "Cheque Issue Date: ".$it."<br/>";
echo "cheque_amount: ".$cheque_amount."<br/>";
echo "Transaction Type: ".$transaction_type."<br/>";
echo "Cheque Status: ".$cheque_status."<br/>";
echo "Issued to: ".$issued_to."<br/>";
echo "Issued From: ".$issued_from."<br/>";
echo "Remarks: ".$remarks."<br/>"; */

$link_host=getConnectionLink();
$con_status = getDB();
if($con_status){// Connection to database successful
	
	if(($transaction_type == "Debit") && ($cheque_status == "CLEARED")){ 
		// 1. Update the 'CHEQUE_STATUS' field of "cheque_master" table as CLEARED.
		// 2. Insert transaction details in USER_DEBIT_DETAILS_MASTER
		// 3. Update the 'BALANCE' field of CUSTOMER_MASTER_LIST 
		try{
        		$sql_Update_cheque_master= "UPDATE `cheque_management`.`cheque_master` SET cheque_status='$cheque_status' WHERE cheque_no='$cheque_no' AND user_id='$user_id'";
				$query_status = mysql_query($sql_Update_cheque_master); // 1. Update the 'CHEQUE_STATUS' field of "cheque_master" table as CLEARED.
				if($query_status){ // 2.Insert transaction details in USER_DEBIT_DETAILS_MASTER
					$reference_id = "Debited From Account By Cheque No: ".$cheque_no ;
					$sql_Insert_user_debit_details_master= "INSERT INTO user_debit_details_master(`user_id`, `date`, `reference_id`, `transaction_type`, `debit_amount`) VALUES ('$user_id','$it','$reference_id','$transaction_type','$cheque_amount')";
					$query_status=mysql_query($sql_Insert_user_debit_details_master);
					if($query_status){ // 3. Update the 'BALANCE' field of CUSTOMER_MASTER_LIST table.
						$user_account_no = "SELECT `user_account_no` FROM `cheque_management`.`cheque_master` where `cheque_no` = '$cheque_no' ";
						$result=mysql_query($user_account_no,$link_host);
						while ($row = mysql_fetch_array($result)) {
							$user_account_no = $row["user_account_no"];
						}
						$presence_balance = "select `balance` from `customer_master_list` where `user_account_no` = '$user_account_no'";
						$result=mysql_query($presence_balance,$link_host);
						while ($row = mysql_fetch_array($result)) {
							$balance = $row["balance"];
						}
						$balance = $balance - $cheque_amount;
						$sql_Update_cheque_master= "UPDATE `cheque_management`.`customer_master_list` SET balance='$balance' WHERE user_account_no='$user_account_no' AND user_id='$user_id'";
						$query_status=mysql_query($sql_Update_cheque_master);
						if($query_status){
							// Insert this transaction details in the "USER_TRANSACTION_HISTORY_MASTER"
							$today = date("Y-m-d");
							$description = "Description Details";
							$reference_id = "Paid to ".$issued_to;
							$sql_USER_TRANSACTION_HISTORY_MASTER= "INSERT INTO USER_TRANSACTION_HISTORY_MASTER(`REFERENCE_ID`,`USER_ID`, `VALUE_DATE`, `TRANSACTION_DATE`, `CHEQUE_NO`, `DESCRIPTION`, `IFSC_CODE`, `TRANSACTION_TYPE`, `AMOUNT`, `BALANCE`) VALUES ('$reference_id','$user_id','$it','$today','$cheque_no','$description','$ifsc_code','$transaction_type','$cheque_amount','$balance')";
							$query_status=mysql_query($sql_USER_TRANSACTION_HISTORY_MASTER);
							if($query_status){
								$status = "Details updated successfully !";
								header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
							}
							else{
								//$status = "Error in inserting data in USER_TRANSACTION_HISTORY_MASTER !";
								$status = "Error in processing request !";
								header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
							}	
						}
						else{
							$status = "Error in processing request !";
							header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
						}
					}
				}
				else{
					$status = "Error in processing request !";
					header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
				}
		}
		catch(Exception $e){
			$status = "Error in processing request !";
			header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no); 
		}
	}
	
	
	
	if(($transaction_type == "Credit") && ($cheque_status == "CLEARED")){ 
		// 1. Update the 'CHEQUE_STATUS' field of "cheque_master" table as CLEARED.
		// 2. Insert transaction details in USER_CREDIT_DETAILS_MASTER
		// 3. Update the 'BALANCE' field of CUSTOMER_MASTER_LIST
	     try{	
				$sql_Update_cheque_master= "UPDATE `cheque_management`.`cheque_master` SET cheque_status='$cheque_status' WHERE cheque_no='$cheque_no' AND user_id='$user_id'";
				$query_status = mysql_query($sql_Update_cheque_master); // 1. Update the 'CHEQUE_STATUS' field of "cheque_master" table as CLEARED.
				if($query_status){ // 2.Insert transaction details in USER_CREDIT_DETAILS_MASTER
							$reference_id = "Credited to Account by Cheque No: ".$cheque_no ;
							$sql_Insert_user_credit_details_master= "INSERT INTO user_credit_details_master(`user_id`, `date`, `reference_id`, `transaction_type`, `credit_amount`) VALUES ('$user_id','$it','$reference_id','$transaction_type','$cheque_amount')";
							$query_status=mysql_query($sql_Insert_user_credit_details_master);
							if($query_status){ // 3. Update the 'BALANCE' field of CUSTOMER_MASTER_LIST table.
									$user_account_no = "SELECT `user_account_no` FROM `cheque_management`.`cheque_master` where `cheque_no` = '$cheque_no' ";
									$result=mysql_query($user_account_no,$link_host);
									while ($row = mysql_fetch_array($result)) {
											$user_account_no = $row["user_account_no"];
									}
									$presence_balance = "select `balance` from `customer_master_list` where `user_account_no` = '$user_account_no'";
									$result=mysql_query($presence_balance,$link_host);
									while ($row = mysql_fetch_array($result)) {
											$balance = $row["balance"];
									}
									$balance = $balance + $cheque_amount;
									$sql_Update_cheque_master= "UPDATE `cheque_management`.`customer_master_list` SET balance='$balance' WHERE user_account_no='$user_account_no' AND user_id='$user_id'";
									$query_status=mysql_query($sql_Update_cheque_master);
									if($query_status){
									// Insert this transaction details in the "USER_TRANSACTION_HISTORY_MASTER"
										    $today = date("Y-m-d");
										    $description = "Description Details";
										    $reference_id = "Received from ".$issued_from;
										    $sql_USER_TRANSACTION_HISTORY_MASTER= "INSERT INTO USER_TRANSACTION_HISTORY_MASTER(`REFERENCE_ID`,`USER_ID`, `VALUE_DATE`, `TRANSACTION_DATE`, `CHEQUE_NO`, `DESCRIPTION`, `IFSC_CODE`, `TRANSACTION_TYPE`, `AMOUNT`, `BALANCE`) VALUES ('$reference_id','$user_id','$it','$today','$cheque_no','$description','$ifsc_code','$transaction_type','$cheque_amount','$balance')";
										    $query_status=mysql_query($sql_USER_TRANSACTION_HISTORY_MASTER);
										    if($query_status){
										    	$status = "Details updated successfully !";
										    	header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
										    }
										    else{
										    	//$status = "Error in inserting data in USER_TRANSACTION_HISTORY_MASTER !";
										    	$status = "Error in processing request !";
										    	header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
										    }
											$status = "Details updated successfully !";
											header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
									}
							}			
							else{
										$status = "Error in processing request !";
										header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
							}
			}
			else{
						$status = "Error in processing request !";
						header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
			}	
		}
		catch(Exception $e){
			$status = "Error in processing request !";
			header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id."&cheque_no=".$cheque_no);
		}
	}
}	
else{// Connection to database failed
	$status = "Database Error";
	//header("Location: update_cheque_status_EDITABLE.php?status=".$status."&session_id=".$session_id);
}
?>