<style>
<!--
#ChequeDataInsertFormWrapper {
	position:absolute;
	width:646px;
	height:307px;
	z-index:1;
	left: 80px;
	top: 5px;
}
.ChequeDataInsert-form-block {
    float:left;
    margin:0 10px 10px 0;
    text-align:center;
    width:260px;
}
.ChequeDataInsert-form-block form {
	position:absolute; /* Testing */
	-moz-border-radius:5px;
	-moz-box-shadow:0 0 10px #333;
	-webkit-border-radius: 15px;
	-webkit-box-shadow: 0 0 10px #333;
	border:3px solid white;
	/*padding:26px;*/
	left: 5px;
	/*top: 13px;*/
	width: 643px;
	height: 310px;
}
form.chequedatainsert_form{
	position:absolute;
	background-color: #FF9900;
	width:628px;
	float: left;
	text-align: right;
	margin-right: 6px;
	margin-top:2px;
	height: 290px;
}
form.chequedatainsert_form legend
{
	color: #FFFFFF;
    padding:1px;
    margin-left: 14px;
    font-family:Palatino Linotype;
    font-weight:bold;
    font-size: 14px;
    font-weight:100;
}
form.chequedatainsert_form fieldset.row1 label{
    color: #FFFFFF;
    width:110px;
    float: left;
    text-align: right;
    margin-right: 6px;
    margin-top:2px;
	
	font-family:Palatino Linotype;
    font-size:10px;
	font-weight:bold;
}
form.chequedatainsert_form input{
    width: 140px;
    color: #505050;
    float: left;
    margin-right: 5px;
}
form.chequedatainsert_form fieldset.row2 label{
    color: #FFFFFF;
    width:110px;
    float: left;
    text-align: right;
    margin-right: 6px;
    margin-top:2px;
	
	font-family:Palatino Linotype;
    font-size:10px;
	font-weight:bold;
}
.button
{
    background: #3BB9FF url("images/overlay.png") repeat-x;
    /*padding: 8px 10px 8px;*/
    color: #fff;
    text-decoration: none;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
    cursor: pointer;
    float:right;
    font-size:10px;
    /*margin:10px;*/
}
-->
</style>
<body background="images/mask_background.jpg">		
<div id="ChequeDataInsertFormWrapper">
<div class="ChequeDataInsert-form-block">
<h3 align="left">
<span style="font-family: 'Verdana'; color: white; font-weight: bold;font-size: 12px;margin-left: 10px;">
<?php 
		$status= (isset($_GET['status'])?$_GET['status']:""); 
		echo $status;
		
?>
</span>
</h3>
<?php 
		include("DatabaseOperations.php");
		session_start(); 				// Fetch the Session Values which had been set in login_handler.php
		$user_id=$_SESSION['user_id'];
		$session_id=$_SESSION['session_id'];
		$link_host=getConnectionLink();
		$con_status = getDB();
		$cheque_no = $_GET['cheque_no'];
		//$sql = "SELECT * FROM `cheque_management`.`cheque_master` where `cheque_status` = 'IN PROCESS' and `user_id` = '$user_id'";
		$sql = "SELECT * FROM `cheque_management`.`cheque_master` where `cheque_status` = 'IN PROCESS' and `cheque_no` = '$cheque_no'";
		$result=mysql_query($sql,$link_host);
		$resultingArray= mysql_fetch_array($result);
?>
<form name="chequedatainsert_form" class="chequedatainsert_form" action="update_cheque_status_EDITABLE_handler.php" method="post">
<fieldset class="row1">
<legend align="center">Cheque Details</legend>
<p>
<label>Cheque No:</label><input type="text" id="cheque_no" name="cheque_no" value="<?php echo $resultingArray[0]; ?>" readonly="readonly"/>
<label>Bank IFSC Code:</label><input type="text" id="ifsc_code" name="ifsc_code" value="<?php echo $resultingArray[1]; ?>" readonly="readonly"/></p>
<p align="left"> 
<label>Cheque Issue Date: </label><input type="text"  name="it" id="date-pick" value="<?php echo $resultingArray[2]; ?>" readonly="readonly" />
<label>Cheque Amount(Rs.):</label><input type="text" id="cheque_amount" name="cheque_amount" value="<?php echo $resultingArray[3]; ?>" readonly="readonly" />
<label>Transaction Type:</label><input type="text" id="transaction_type" name="transaction_type" value="<?php echo $resultingArray[4]; ?>" readonly="readonly" />
</p>
<p align="left">
<label>Cheque Status: </label>
<select name="cheque_status" class="cheque_status">
<OPTION value="IN PROCESS" selected>IN PROCESS</OPTION>
<OPTION value="CLEARED">CLEARED</OPTION>
<OPTION value="BOUNCED">BOUNCED</OPTION>
</select>
<span style="color: blue;font-family: Verdana;font-size: 10px;font-weight: bold;">* Update</span>
</p>				
</fieldset>
<fieldset class="row2">
<legend align="center">Other Details</legend>
<p> 
<label>Issued to: </label><input type="text"  name="issued_to" id="issued_to" value="<?php echo $resultingArray[6]; ?>" readonly="readonly" />
<label>Issued from:</label><input type="text" id="issued_from" name="issued_from" value="<?php echo $resultingArray[7]; ?>" readonly="readonly" />
<label>Remarks:</label><input type="text" id="remarks" name="remarks" value=""/>
<br/><br/>
</fieldset>
<p align="right">
<button class="button">Update &raquo;</button>
</p> 
</form>
</div>
</div>
</body>