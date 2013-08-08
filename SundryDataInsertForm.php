<div id="MainPage">
<div id="HeaderPageWrapper"><?php include('header.htm');?></div>
<div id="MainPageWrapper">
<div id="WelcomeUserWrapper">
<?php 
		session_start(); // Fetch the Session Values which had been set in login_handler.php
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
<div id="SundryDataInsertFormWrapper">
<div class="SundryDataInsert-form-block">
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
<form name="sundrydatainsert_form" class="sundrydatainsert_form" action="sundrydatainsert_handler.php" method="post" onsubmit="return check();">
<fieldset class="row1">
<legend align="center">Company Information</legend>
<p>
<label>Company Id:</label><input type="text" id="company_id" name="company_id" maxlength="50" />
<label>Company Name:</label><input type="text" id="company_name" name="company_name" maxlength="50" />
</p>
<label>Whether Debitor ? </label>
<input type="checkbox" name="whether_debitor" value="Yes" />
<label>Whether Creditor ? </label>
<input type="checkbox" name="whether_creditor" value="Yes" />
</fieldset>
<fieldset class="row2">
<legend align="center">Contact Person Information</legend>
<p>
<label>Name:</label><input type="text" id="responsible_person" name="responsible_person" maxlength="50"/>
<label>Address:</label><input type="text" id="responsible_person_address" name="responsible_person_address" maxlength="150"/>
</p>
<label>Contact No: </label><input type="text" id="responsible_person_contact_no" name="responsible_person_contact_no" maxlength="15" />
</fieldset>
<p align="right">
<button class="button">Insert &raquo;</button>
</p>
</form>
</div>
</div>
</div>
<div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>