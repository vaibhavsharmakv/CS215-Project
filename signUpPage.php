<?php
$msg = '';
$msgclass= '';

	$firstName = trim($_POST["Fname"]);
	$lastName = trim($_POST["lname"]);
	$DOB = trim($_POST["Dob"]);
	$email= trim($_POST["email"]);
	$password = trim($_POST["pswd"]);
	$confirm= trim($_POST["pswdr"]);
	$flag= false;


if (filter_has_var(INPUT_POST,'submit')) 
{	
	if(!empty($firstName) && !empty($lastName) && !empty($DOB)  )
	{
		if(strlen($password)==0){$msg="The password Feild cannot be Empty";}
		//email 
		if(filter_var($email,FILTER_VALIDATE_EMAIL)===false)
		{
		$msg= "Please Use a Valid Email";
		}
		else
		{	        
			if($password!=$confirm)
			{	
				$msg = "Password Does not match";
			}
			else
			
				

				// database open
				{
					// connection to server
					$conn = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
					if ($conn->connect_error)
					{
						 // conection fail
						die ("Connection failed: " . $conn->connect_error);
				  	}

					// inseting query into table
						  
					$sql = "INSERT INTO user (userEmail,DOB,password,firstName,lastName) values('$email','$DOB','$password','$firstName','$lastName')";
	

					 if (mysqli_query($conn, $sql)) 
				  	{
						$sql = "SELECT firstName FROM user WHERE userEmail='".$email."'\n";
					    	$result = mysqli_query($conn, $sql);
					    	$row = mysqli_fetch_assoc($result);
				    	
		
					    	// login successful and display username
					    	echo "<h1>" ."Welcome ". $firstName."!". "</h1>";
					    	echo  "<h2>"."Your account has been created successfully."."</h2>";
						?>
						<a href="Login.html">Back to Login Page</a><br>
						<a href="SignUp.html">Back to Sign Page</a>
	
						<?php


				  	} // end if 

				 	else
					{
				   	echo "Error: " . $sql . "<br>" . mysqli_error($conn);  
	
					}  
					mysqli_close($conn); 		
				}

				// database closed


			
				
		}
			
	}
	else
	{
         $msg = "Fist or Last Name or DOB cannot be empty";
	}
	
}
if(flag)



?>
<html>
<head>
<title>SignUp Page</title> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="main.css">
<!-- <script type="text/javascript" src= "java.js"></script>-->
</head>

<body>
<h1>Sign Up Page</h1>
<form  action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">    


	<table>
		<?php if($msg != ''):?>
		<tr><td ></td><td><span class = "err" ><?php echo $msg ?></span></td></tr>
		<?php endif; ?>
		<tr><td ></td><td><label = id = "Fname_err" class= "err" ></label></td></tr>
		<tr><td >First Name: </td><td> <input = id="Fname" type="text" name="Fname" size="30" value="<?=$firstName?> " /></td></tr>

		<tr><td ></td><td><label = id = lname_err class= "err" ></label></td></tr>
		<tr><td>Last Name: </td><td> <input id = lname type="text" name="lname" size="30" value="<?=$lastName?> " /></td></tr>

		<tr><td ></td><td><label = id = Dob_err class= "err" ></label></td></tr>
		<tr><td>Date of birth: </td><td> <input type="date" name="Dob" min ="1979-12-31" size="30" value="<?=$DOB?> "/></td></tr>

		<tr><td ></td><td><label = id = email_err class= "err" ></label></td></tr>
 		<tr><td>Email: </td><td> <input  id = email type="text" name="email" size="30" value="<?=$email?> " /></td></tr>

 		<tr><td ></td><td><label = id = "password_err" class= "err" ></label></td></tr>
 		<tr><td>Password: </td><td> <input id = "password" type="password" name="pswd" size="30" /></td></tr>  

		<tr><td ></td><td><label = id = "pswdr_err" class= "err" ></label></td></tr>
 		<tr><td>Confirm Password: </td><td> <input id="pswdr" type="password" name="pswdr" size="30" /></td></tr>             
	</table>

	<p>
		
		<button id="button" class="button" type="submit" name="submit">Submit</button>

		<button  class="button" type="submit">Reset</button>	
	</p>
</form>

<!--<script type="text/javascript" src="signUp.js"></script>-->
</body>
</html>
