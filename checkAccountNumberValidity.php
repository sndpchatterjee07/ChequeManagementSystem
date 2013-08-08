<?php
	include 'DatabaseOperations.php';
	$transaction_type=$_GET['transaction_type'];
	$user_account_no=$_GET['user_account_no']; 
	$cheque_amount=$_GET['cheque_amount'];
	session_start();
	$user_id=$_SESSION['user_id'];
	$link_host=getConnectionLink();
    $con_status = getDB();
    if($con_status){// Connection to database successful
    	$sql1 = "select * from `cheque_management`.`customer_master_list` where `user_account_no` = '$user_account_no'";
    	$result=mysql_query($sql1,$link_host);
    	if(mysql_num_rows($result) < 1){
    		// echo "No such Account !";
    		echo '<span style="font-family: Verdana; color: red;font-size: 12px; font-weight:bold">';
    		echo 'Account number does not match our records !';
    		echo '</span>';
     	}
    	else{ // Account Number found..no need to do anything.
    		
     	}
    	if($transaction_type == 'Debit'){ // Fetch the Account Balance for that account number
     		$sql2 = "select `balance` from `cheque_management`.`customer_master_list` where `user_account_no` = '$user_account_no'";
    		$result=mysql_query($sql2,$link_host);
    		$fields_num = mysql_num_fields($result); // Column Count
    		while($row = mysql_fetch_array($result)) {
    			for ($i = 0; $i<$fields_num; $i++) {
    				$field = mysql_fetch_field($result, $i);
    				$balanceAmount = $row[$field->name]; // Prints Account balance for the user inputted account.
    				if($balanceAmount<$cheque_amount){
    					echo '<span style="font-family: Verdana; color: red;font-size: 12px; font-weight:bold">';
    					echo 'You do not have sufficient funds for this transaction !';
    					echo "</span>";
    				}
    			}
    		}
    	}
   }
   else{// Connection to database failed
   	
   }
?>