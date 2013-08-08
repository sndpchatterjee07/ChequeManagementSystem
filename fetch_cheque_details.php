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
<div id="DisplayLimitWrapper">
<!--Display Limit-->          
<!--<form action="fetch_cheque_details.php" method="post">-->
<p align="right">
<label>
<span style="font-family: Verdana; color: #6E6E6E;font-size: 12px; font-weight:bold">
No. of records :
</span>
</label>
<select id="limit_value" name="limit_value" onchange="limitSetter(this);">
                               <option value="10">10</option>
                               <option value="20">20</option>
                               <option value="30">30</option>
                               <option value="40">40</option>
</select>
</p>
<!--</form>-->
</div>
<div id="SearchWrapper">
<!-- Search Content here -->
<span style="font-family: Verdana; color: #6E6E6E;font-size: 12px; font-weight:bold">
Search:          </span>
<div id="searchFormErrorMsg">
<!--Form errors here :-->
</div>
<form name="searchForm" method="post" action="fetch_cheque_detailsByChqNo.php">
<!-- Form to search details by cheque no. -->
<input id="chqNo" name="chqNo" type="text" value="Cheque No." onblur="if ((this.value == '')) {this.value='Cheque No.';}" onfocus="if ((this.value == 'Cheque No.')) {this.value='';}"/>
<input type="submit" value="Go" />
</form>
</div>
<div id="DisplayWrapper">
<!-- Data fetched dynamically from "cheque_master" table will be displayed here for the current logged in user-->
<?php 
			  		include("DatabaseOperations.php"); 
			  		include("ps_pagination.php");
              		$link_host=getConnectionLink();
					$con_status = getDB();
					//$chqNo= (isset($_GET['chqNo'])?$_GET['chqNo']:""); // Works fine
				
					if(isset($_GET['chqNo'])){
						$chqNo=$_GET['chqNo'];
						//$sql = "SELECT * FROM `cheque_management`.`cheque_master` where `cheque_no` = '$chqNo' and `user_id` = '$user_id' ";
						$sql = "SELECT `cheque_no`,`ifsc_code`,`cheque_issue_date`,`cheque_amount`,`transaction_type`,`cheque_status`,`issued_to`,`issued_from` FROM `cheque_management`.`cheque_master` where `cheque_no` = '$chqNo' and `user_id` = '$user_id' ";
					}
					else{
						//$sql = "SELECT * FROM `cheque_management`.`cheque_master` where `user_id` = '$user_id' ";
						$sql = "SELECT `cheque_no`,`ifsc_code`,`cheque_issue_date`,`cheque_amount`,`transaction_type`,`cheque_status`,`issued_to`,`issued_from` FROM `cheque_management`.`cheque_master` where `user_id` = '$user_id' ";
					}
					$result=mysql_query($sql,$link_host);
					$num_rows = mysql_num_rows($result);
					$pagination=new PS_Pagination($link_host,$sql,6,5,"session_id=$session_id"); 
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
 */					}
              ?> <!-- End of dynamic data fetched from table -->
          </div>
  </div>
  <div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>


