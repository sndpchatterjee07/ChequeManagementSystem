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
<div id="SearchWrapper">
<!-- Search Content here -->
<span style="font-family: Verdana; color: #6E6E6E;font-size: 12px; font-weight:bold">Search:</span>
<div id="searchFormErrorMsg">
<!--Form errors here :-->
</div>
<form name="searchForm" method="post" action="fetch_sundry_detailsByCompanyId.php">
<!-- Form to search details by bank code. -->
<input id="companyId" name="companyId" type="text" value="Company Id" onblur="if ((this.value == '')) {this.value='Company Id';}" onfocus="if ((this.value == 'Company Id')) {this.value='';}"/>
<input type="submit" value="Go" />
</form>
</div>
<div id="DisplayWrapper">
<!-- Data fetched dynamically from "sundry_info_master" table will be displayed here for the current logged in user-->	
<?php 
	include("DatabaseOperations.php");
	include("ps_pagination.php");
	$link_host=getConnectionLink();
	$con_status = getDB();
    if(isset($_GET['companyId'])){ // Displays the results when a user searches by Co.Id
          	$companyId=$_GET['companyId'];
		    //$sql = "SELECT * FROM `cheque_management`.`sundry_info_master` where `company_id` = '$companyId' and `user_id` = '$user_id'";
          	$sql = "SELECT `company_id`,`company_name`,`whether_debitor`,`whether_creditor`,`responsible_person`,`responsible_person_no` FROM `cheque_management`.`sundry_info_master` where `company_id` = '$companyId' and `user_id` = '$user_id'";
	}
	else{
		            	   $sql = "select `company_id`,`company_name`,`whether_debitor`,`whether_creditor`,`responsible_person`,`responsible_person_no` from `cheque_management`.`sundry_info_master` where `user_id` = '$user_id'";
	}
	$result=mysql_query($sql,$link_host);
	$num_rows = mysql_num_rows($result);
	$pagination=new PS_Pagination($link_host,$sql,6,5,"session_id=$session_id"); 
	$rs = $pagination->paginate();
	if($rs){// Query returned a resultset
			$fields_num = mysql_num_fields($result); // Column Count
			echo "<table id = DisplaySundryDetailsTable>";
			for($i=0; $i<$fields_num; $i++){
					$field = mysql_fetch_field($result,$i);
					echo '<th>' . strtoupper($field->name) . '</th>';
			}
			echo '</tr>';
			while($row = mysql_fetch_array($rs)) { //Loop through the mysql result set
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
		}	
?>	
</div>
</div>
<div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>