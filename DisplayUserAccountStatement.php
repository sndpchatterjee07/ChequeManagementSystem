<div id="MainPage">
<div id="HeaderPageWrapper"><?php include('header.htm');?></div>
<div id="MainPageWrapper">
<div id="WelcomeUserWrapper">
<?php 
		// Fetch the Session Values which had been set in login_handler.php
		session_start();
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
<div id="SearchWrapper">
<!-- Search Content here -->
<span style="font-family: Verdana; color: #6E6E6E;font-size: 12px; font-weight:bold">
Search:          </span>
<div id="searchFormErrorMsg">
<!--Form errors here :-->
</div>
<form name="searchForm" method="post" action="">
<!-- Form -->
<input id="reference_id" name="reference_id" type="text" value="Reference Id" onblur="if ((this.value == '')) {this.value='Reference Id';}" onfocus="if ((this.value == 'Reference Id')) {this.value='';}"/>
<input type="submit" value="Go" />
</form>
</div>  
<div id="DisplayWrapper">
<!-- Dynamic Data -->
<?php 
				include("DatabaseOperations.php");
				include("ps_pagination.php");
				$link_host=getConnectionLink();
				$con_status = getDB();
				$sql = "SELECT `reference_id`,`value_date`,`transaction_date`,`cheque_no`,`ifsc_code`,`transaction_type`,`amount`,`balance` FROM `cheque_management`.`user_transaction_history_master` where `user_id` = '$user_id' ";
				$result=mysql_query($sql,$link_host);
				$num_rows = mysql_num_rows($result);
				$pagination=new PS_Pagination($link_host,$sql,3,5,"session_id=$session_id");
				$rs = $pagination->paginate();
				if($rs){ // Query returned a resultset
					$fields_num = mysql_num_fields($result); // Column Count
					echo "<table id = DisplayChequeDetailsTable>";
					for($i=0; $i<$fields_num; $i++)
					{
					$field = mysql_fetch_field($result,$i);
					echo '<th>' . strtoupper($field->name) . '</th>';
					}
							echo '</tr>';
					//Loop through the mysql result set
					while($row = mysql_fetch_array($rs)) {
					echo '<tr>';
					for ($i = 0; $i<$fields_num; $i++) {
					$field = mysql_fetch_field($result, $i);
						echo '<td>'.$row[$field->name] . '</td>';
					}
					echo '</tr>';
					}
					echo "</table>";
						echo $pagination->renderFullNav();
				}
				else{  // Query didn't returned any resultset.
				$msg = "No records found !";
				echo '<script language="javascript">alert("No Records found !"); return false;</script>';
/* 						$domObj = new DomDocument;
						echo $domObj->getElementById('searchFormErrorMsg');
				$domObj->getElementById('searchFormErrorMsg');
				*/
				}
?><!-- End of dynamic data fetched from table -->
</div>
  </div>
  <div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>

