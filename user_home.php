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
<div id="Column1Wrapper">
<ul id="Column1Navigation">
<?php echo "<li><a href=\"SundryDataInsertForm.php?session_id=".$session_id."&status=Start\">Add Sundry Data</a></li>"; ?>
<?php echo "<li><a href=\"AddNewBankForm.php?session_id=".$session_id."&status=Start\">Add New Bank A/C</a></li>"; ?> 	
<?php echo "<li><a href=\"ChequeDataInsertForm.php?session_id=".$session_id."&status=Start\">Add New Cheque</a></li>"; ?>
<?php echo "<li><a href=\"DisplayUserAccountStatement.php?session_id=".$session_id."&status=Start\">Account Statement</a></li>"; ?> <li><a href="test.html">Report Section</a></li>
</ul>
</div>
<div id="Column2Wrapper">
<img src="images/cs.png" alt="Customer Support" width="413" height="176" />
<p align="justify">
<span style="font-family: 'Verdana'; color: white;font-size: 12px;">
<marquee id="mq1" scrollamount="1" scrolldelay="10" direction="up" width="400" height="95" onmouseover="document.getElementById('mq1').stop();" onmouseout="document.getElementById('mq1').start();">
If you are a developer (regardless of what you develop), you know that testing your product out is one of the most important steps in the development process. Apart from running functionality tests you might also need to run scalability as well as compatibility tests and that’s where dummy data come in.
For WordPress you will most of the time need dummy data for posts, users or categories, things that take times to manually create. It is, therefore, much quicker and convenient if you have a tool to automatically generate those data. Fortunately there are some ready-made ones out there that can help you 
with such task and you will know more about them after reading this article. 
</marquee>
</span>
</p> 
<p align="justify"><span style="font-family: 'comic sans'; color: white;font-size: 14px; font-weight:bold">Like our site or have something to say? </span></p>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="_Csandeep">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.        parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<div class="g-plusone" data-annotation="inline" data-width="300"></div>
<script type="text/javascript">
(function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/plusone.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
</div>
<div id="Column3Wrapper">
<p align="center">
<span style="font-family: 'comic sans'; color: red;font-size: 14px; font-weight:bold;">
<blink><!--<img src="images/signup-button.png" width="50" height="50" />--><b>Important Reminders:</b></blink>
</span>
</p>
<?php 
 	include('DatabaseOperations.php');
	include("ps_pagination.php"); 
	$link_host=getConnectionLink();
    $con_status = getDB();
	$sql = "SELECT `cheque_no`,`transaction_type` FROM `cheque_management`.`cheque_master` where `cheque_issue_date`<CURRENT_DATE() and `user_id` = '$user_id' "; 
	$result=mysql_query($sql,$link_host);
	$num_rows = mysql_num_rows($result);
	$pagination=new PS_Pagination($link_host,$sql,4,5,"session_id=$session_id");
	$rs = $pagination->paginate();
	if($rs){ // Query returned a resultset
		$fields_num = mysql_num_fields($result); // Column Count
		//echo "<table id = DisplayChequeDetailsTable>";
		for($i=0; $i<$fields_num; $i++){
				$field = mysql_fetch_field($result,$i);
				//echo '<th>' . $field->name . '</th>';
				//echo '<th>PENDING CHEQUES:</th>';
		}
		echo '</tr>';
		while($row = mysql_fetch_array($rs)) { //Loop through the mysql result set
			//echo '<tr>';
			for ($i = 0; $i<$fields_num; $i++) {
					$field = mysql_fetch_field($result, $i);
					//echo '<td>&nbsp;&nbsp;<span style="font-family: Palatino Linotype; color: #6E6E6E;font-size: 10px;">'.$row[$field->name] . '</td>';
			}
			//echo '</tr>';
		}
		//echo "</table>";
		//echo "&nbsp;&nbsp;".$pagination->renderFullNav();
    	} 
	else{  // Query didn't returned any resultset.
			$msg = "No records found !";
	}			 
?>
</div>
</div>
<div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>