<div id="MainPage">
<div id="HeaderPageWrapper"><?php include('header.htm');?></div>
<div id="MainPageWrapper">
<div id="WelcomeUserWrapper">
<?php 
	session_start();
	$user_id=$_SESSION['user_id'];
	$session_id=$_SESSION['session_id']; 		// Fetch the Session Values which had been set in login_handler.php
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
<div id="BankDataInsertFormWrapper">
<div class="BankDataInsert-form-block">
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
<form name="bankdatainsert_form" class="bankdatainsert_form" action="bankdatainsert_handler.php" method="post" onsubmit="return check_bankdatainsert_form();">
 <!-- Form Fields begin -->
<fieldset class="row1">
<legend align="center">Bank Information</legend>
<p>
<label>IFSC Code:</label><input type="text" id="bank_code" name="bank_code" maxlength="11"/>
<label>Bank Name:</label><input type="text" id="bank_name" name="bank_name" maxlength="50"/>
<label>Bank Address:</label><input type="text" id="bank_address" name="bank_address" maxlength="150"/>
<label>Bank Contact No:</label><input type="text" id="bank_contactno" name="bank_contactno" maxlength="15"/>
</p>
</fieldset>
<p align="left">
<a href="http://www.ncr.indianrailways.gov.in/uploads/files/1297254119993-IFSC_CODE.pdf">List of IFSC Codes for Banks in India</a>
</p> 
<p align="right">
<button class="button">Insert &raquo;</button>
</p> 
</form>
</div>
</div>
</div>
<div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>

