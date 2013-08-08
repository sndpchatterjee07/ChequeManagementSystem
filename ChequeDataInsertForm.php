<div id="MainPage">
<div id="HeaderPageWrapper"><?php include('header.htm');?></div>
<div id="MainPageWrapper">
<div id="WelcomeUserWrapper">
<?php 
	session_start(); // // Fetch the Session Values which had been set in login_handler.php
	$user_id=$_SESSION['user_id'];
	$session_id=$_SESSION['session_id'];
	if(($_REQUEST['session_id']=="")||($_REQUEST['session_id']!=$_SESSION['session_id'])) header("location:index.php?status=Session expired.Please login!");
	if(http_build_query($_GET, '', '|') != "") echo 'Welcome '.'<span style="font-family: Verdana; color: #6E6E6E;font-size: 12px; font-weight:bold">'.$user_id.'</span>';
?>
</div>
<div id="MenuWrapper">
<ul id="css3menu1" class="topmenu">
<?php echo "<li class=topfirst><a href=\"fetch_sundry_details.php?session_id=".$session_id."\">Sundry Details</a></li>"; ?>
<?php echo "<li class=topfirst><a href=\"fetch_bank_details.php?session_id=".$session_id."\">Available Banks</a></li>"; ?>
<?php echo "<li class=topfirst><a href=\"fetch_cheque_details.php?session_id=".$session_id."\">Cheque Details</a></li>"; ?>
<?php echo "<li class=topfirst><a href=\"update_cheque_status.php?session_id=".$session_id."\">Update Cheque Status</a></li>"; ?>
</ul>
</div>
<div id="LogoutWrapper">
        <?php echo "<a href=\"user_home.php?session_id=".$session_id."\">Home</a>"; ?>
| <a href="logout.php">Log Out</a>
</div>
<div id="ChequeDataInsertFormWrapper">
<div class="ChequeDataInsert-form-block">
<h3 align="left">
<span style="font-family: 'Verdana'; color: white; font-weight: bold;font-size: 12px;margin-left: 10px;">
<?php 
		$page_status= (isset($_GET['status'])?$_GET['status']:""); // Works fine
		if(($page_status!="")&&($page_status!="Start")){
				 echo $page_status;
		}

?>
</span>
</h3>
<?php 
	include("DatabaseOperations.php");
	$link_host=getConnectionLink();
	$con_status = getDB();
	$sql = "SELECT `ifsc_code` FROM `cheque_management`.`bank_master`";
	//$sql = "SELECT DISTINCT(`ifsc_code`) FROM `cheque_management`.`customer_master_list` where `user_id` = '$user_id' ";
	$result=mysql_query($sql,$link_host);
	$num_rows = mysql_num_rows($result);      // Row Count
	$fields_num = mysql_num_fields($result); // Column Count
?>
<form name="chequedatainsert_form" class="chequedatainsert_form" action="chequedatainsert_handler.php" method="post" onsubmit="return check_chequedatainsert_form();" >
<fieldset class="row1">
<legend align="center">Cheque Details</legend>
<p>
<label>Cheque No:</label><input type="text" id="cheque_no" name="cheque_no" value="" maxlength="50"/>
<label>Bank IFSC Code:</label>
<select class="ifsc_code" id="ifsc_code" name="ifsc_code">
<?php  
		while ($row = mysql_fetch_array($result)) {
			echo '<option>';
			echo $row["ifsc_code"];
			echo '</option>';
		}						
?>        
</select>
</p>
<p align="left"> 
<label>Cheque Issue Date: </label><input type="text"  name="it" id="date-pick" />
<label>Cheque Amount(Rs.):</label><input type="text" id="cheque_amount" name="cheque_amount" value=""/>
</p>
<br/>
<p align="left"> 
<label>Transaction Type: </label>
<select id="transaction_type" name="transaction_type" class="transaction_type" 
 onchange="if(document.getElementById('transaction_type').options[this.selectedIndex].id.match('Debit')) {
 	document.getElementById('issued_to').disabled=false;
 	document.chequedatainsert_form.issued_from.value = '';
	document.getElementById('issued_from').disabled=true;
}
if(document.getElementById('transaction_type').options[this.selectedIndex].id.match('Credit')) {
	document.getElementById('issued_from').disabled=false;
	document.chequedatainsert_form.issued_to.value = '';
	document.getElementById('issued_to').disabled=true;
}">
<OPTION value="Select" selected>-- Select Transaction Type --</OPTION>
<OPTION id="Debit" value="Debit">Debit</OPTION>
<OPTION id="Credit" value="Credit">Credit</OPTION>
</select>
</p>
<!-- <p align="left">-->
<!-- <label>Cheque Status: </label>-->
<!-- Since the default value is "IN PROCESS",it is taen as hidden -->
<input type="hidden"  name="cheque_status" id="date-pick"  value="IN PROCESS" maxlength="50"/>
 <!-- </p>-->
</fieldset>
<fieldset class="row2">
<legend align="center">Debtor/Creditor Details</legend>
<p> 
<label>In favour of: </label><input type="text"  id="issued_to" name="issued_to" disabled="disabled" maxlength="50"/>
<label>Payor Name:</label><input type="text" id="issued_from" name="issued_from" disabled="disabled" maxlength="50"/>
<label>Account Number:</label>
<input type="text" id="user_account_no" name="user_account_no" maxlength="20" onblur="checkAccountNumberValidity()"/>
<label>Remarks:</label><input type="text" id="remarks" name="remarks" value="" maxlength="50"/>
<label><a href="javascript:ShowContent('pop-up')" onmouseover="ShowContent('pop-up')" onmouseout="HideContent('pop-up')">My Accounts</a></label>
</fieldset>
<!-- HIDDEN / POP-UP DIV -->
<div id="pop-up">
      <?php include 'popupUserAccountsDisplayer.php'; ?>
</div>
<div id="isValidAccountNo">
<!-- Dynamically populate with Ajax Response -->

</div>
<p align="right">
<button class="button">Insert &raquo;</button>
</p> 
</form>
</div>
</div>
</div>
<div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>