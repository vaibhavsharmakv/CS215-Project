<?php

//validate input from email and password
$msg='';

if (filter_has_var(INPUT_POST,'submit'))
{
$email= trim($_POST["email"]);
$password=trim($_POST["pswd"]);

echo $email;
echo $password;

//clear
	if(!empty($email) && !empty($password) )
	{
	
		//make a connection to sql
		
		$conn = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
		if ($conn->connect_error)
		{
			 // conection fail
			die ("Connection failed: " . $conn->connect_error);
	 	}
		$q = "SELECT userEmail FROM user WHERE userEmail='$email' AND password = '$password';";
		$result = mysqli_query($conn, $q);		
		$row = mysqli_fetch_assoc($result);
		var_dump($result);
		if (mysqli_num_rows($result)!=0) 
		{		
			
			
	  		// login successful
	  		session_start();
			$_SESSION["userEmail"] = $row["userEmail"];
			
			header("Location:".signUpPage.php );
			$conn->close();
			exit();
		}

		 else
        	 {
			// login unsuccessful
			$msg = "The username/password combination was incorrect.";
			$conn->close();
		}
	
	
	}
	else
	{
	$msg='Email or password cannot be empty';
	}


}
?>

<!DOCTYPE html>
<html>
 <head>
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" type="text/css" href="main.css">
   <!-- <script type="text/javascript" src= "java.js"></script> -->
 </head>

 </html>
 <body>
	<div>
	<h1>
	Kv's Texting Website
	</h1>
	</div>
	<div class="imgcontainer">
 	</div>

 <form  action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">    
    <table>
    <?php if($msg != ''):?>
    <tr><td ></td><td><span class = "err" ><?php echo $msg ?></span></td></tr>
    <?php endif; ?>
    <tr><td ></td><td><label = id = "email_err" class= "err" ></label></td></tr>
    <tr><td>Email: </td><td> <input  id = "email" type="text" name="email" size="30" /></td></tr>
    	 
   
    <tr><td ></td><td><label = id = "password_err" class= "err" ></label></td></tr>
    <tr><td>Password: </td><td> <input id = "password" type="password" name="pswd" size="30" />
    <input type="checkbox" checked="checked"> Remember me
    </td></tr>
    
  </table>
  <button id="b2" class="button" type="submit" name ="submit">Login</button>
    	<a href="signUpPage.php"><button class="button" type="submit">Sign up</button></a>
       
 </form>   


 	 <div class="container" style="background-color:#f1f1f1">
      
   
   </div>
    <table>
    <tr><td ></td><td><label = id = "secretCode_err" class= "err" ></label></td></tr>
    <tr><td>Private Code: </td><td> <input  id = "secretCode" type="text" name="secretCode" size="30" /></td></tr>


 	  </table>
    
 	 	<button id = "btn" class="button" type="submit">See Message</button>
 <!--	<script type="text/javascript" src="login.js"></script> -->
</body>
</html>﻿
