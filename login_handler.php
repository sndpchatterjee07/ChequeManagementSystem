<html>
<head>
<title></title>
</head>
<body>
<?php
	include("DatabaseOperations.php");
	$user_id=$_POST["user_id"];
	$password=$_POST["password"];
	//echo $user_id;
	//echo $password;
	$status=validateLogin($user_id,$password);
	if(!$status) { 
    	header('Location: index.php?status=Login Failed !'); // Redirect to Home Page with the error message printed above the login form.
    }
    else{
    	    $mysqli = new mysqli("localhost", "root", "password", "cheque_management");
	        $query = "select `user_id` from `user_master` where `user_id` = '$user_id' and `password` = '$password'";
			if ($result = $mysqli->query($query)) {
					while ($row = $result->fetch_row()) {
						//echo $row[0];  
						$status=$row[0];
		            }
		            // Code to set the sessions....
		            
		            //First checks for an existing session ID number,
		            //If it finds one, it sets up the $_SESSION array.If not, it starts a new session by creating a new session ID number.
		            session_start(); // creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.
		            $_SESSION['user_id']=$user_id;// Binding the form inputted userid value with a session variable.
		            $_SESSION['session_id']= session_id();// Explicitly generating a unique session id for the current session. 
		            $session_id=$_SESSION['session_id'];// Assigning newly generated session id to a variable.
		            header('Location: user_home.php?status='.$status.'&session_id='.$session_id);
	        } 
	        //mysqli_free_result($result);
     }
?>
</body>
</html>
