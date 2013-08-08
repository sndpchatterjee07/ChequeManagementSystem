<div id="MainPage">
<div id="HeaderPageWrapper"><?php include('header.htm');?></div>
<div id="MainPageWrapper">
<div id="WelcomeUserWrapper">
<?php 
	session_start(); 	// Fetch the Session Values which had been set in login_handler.php
	$user_id=$_SESSION['user_id'];
	$session_id=$_SESSION['session_id'];
	//if(($_REQUEST['session_id']=="")||($_REQUEST['session_id']!=$_SESSION['session_id'])) header("location:index.php?status=Session expired.Please login!");
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
<div id="AddNewBankAccountFormWrapper">
<div class="AddNewBankAccount_form-block">
<h3 align="left">
<span style="font-family: 'Verdana'; color: white; font-weight: bold;font-size: 12px;margin-left: 10px;">
<?php 
		$page_status= (isset($_GET['status'])?$_GET['status']:""); // Works fine
		if(($page_status!="")&&($page_status!="Start")){
				 echo $page_status;
		}
		
		
		$ifsc_code= (isset($_POST['ifsc_code'])?$_POST['ifsc_code']:""); 
		if(($ifsc_code!="")){
			echo $ifsc_code;
			die;
		}
?>
</span>
</h3>
<?php 
	include("DatabaseOperations.php");
	$link_host=getConnectionLink();
	$con_status = getDB();
	$sql = "SELECT `ifsc_code` FROM `cheque_management`.`bank_master`"; // When customer/user tries to add a new bank account,the List of branches in India will show in the dropdown.
	$result=mysql_query($sql,$link_host);
?>
<form name="AddNewBankAccount_form" class="AddNewBankAccount_form" action="AddNewBankAccount_form_handler.php" method="post" onsubmit="return check_AddNewBankAccount_form();">
<fieldset class="row1">
<legend align="center">Account Information</legend>
<p align="left">
<label>Bank IFSC Code:</label>
<input type="text"  id="ifsc_code" name="ifsc_code" readonly="readonly"/>
<input id="btn1" name="btn1" type="button" value="Search Bank Code" size="30" onclick="javascript:pop('popupUserBankCodes.php');" />
<br/><br/>
</p>

<p align="left">
<label>Account No:</label><input type="text"  id="user_account_no" name="user_account_no" maxlength="20" />
<label>Balance(Rs.):</label><input type="text"  id="balance" name="balance" />
</p>
<br/>


 
<br/>
<!--<p align="left">
<label>Balance(Rs.):</label><input type="text"  id="balance" name="balance" />
</p>-->
</fieldset>
<p align="right"><button class="button">Add Account &raquo;</button></p>          
</form>                
</div>
</div>
</div>
<div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>