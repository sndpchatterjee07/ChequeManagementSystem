<div id="MainPage">
  <div id="HeaderPageWrapper"><?php include('header.htm');?></div>
  <div id="MainPageWrapper">
    <div id="LeftColumn">
<!--<a href="https://www.paypal.com/webapps/mpp/home"><img src="images/paypal_rounded_corners.jpg" alt="Paypal" width="445" height="258" longdesc="images/paypal2.jpg" /></a>	-->    
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/
cabs/flash/swflash.cab#version=7,0,0,0" width="392" height="250" 
id="ChangeProfile.swf" align="left">
      <param name="allowScriptAccess" value="sameDomain">
         <param name="movie" 
                  value="flash/ChangeProfile.swf?
                  flv=flash/ChangeProfile.flv">
         <param name="quality" value="high">
         <param name="bgcolor" value="#ffffff">
<embed src="flash/ChangeProfile.swf?
                  flv=flash/ChangeProfile.flv" quality="high" bgcolor="#ffffff" width="392" height="250" name="ChangeProfile.swf" 
align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
</object>


</div>
    <div id="LoginFormWrapper">
      <div class="login-block">
	  		<h3 align="left">
			<span style="font-family: 'Verdana'; color: white; font-weight: bold;font-size: 12px;margin-left: 10px;">
			<?php 
						$queryString = http_build_query($_GET, '', '|');
						//echo $queryString;
						if($queryString == "status=Session+expired.Please+login%21"){
							echo("Session expired.Please login!");
						}
						if($queryString == "status=Login+Failed+%21"){
							echo("Login failed !");
						}	
						if($queryString == "status=Registration+Succesful."){
							echo("Congrats ! Login to explore...");	
						}
			?>
			</span>
			</h3>
			<br/>
			<form name="UserLogin" action="login_handler.php" method="post" class="loginform">
				<p align="left"><label for="user_id">User Id :</label><input type="text" name="user_id" id="user_id"  align="right"/></p>
				<p align="left"><label for="password">Password :</label><input type="password" name="password" id="password" align="right" /></p>
			    <p align="left"><input type="submit" id="submit" value="Login"/>
                <b>
					<span style="font-family: 'Palatino Linotype', fantasy; color: white; font-size:14px;">Want to register ?</span>
				</b> 
				<a href="Registration.php">
					<img id="signupbutton" src="images/signup-button.png" alt="signup" width="76" height="41" longdesc="signup-button.png" />
				</a>
			  </p>
			</form>	
	  </div>
    </div>
  </div>
  <div id="FooterPageWrapper"><?php include('footer.php');?></div>
</div>