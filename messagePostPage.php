<?php
session_start();
$userEmail=$_SESSION['userEmail'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$imagePath='upload/'.$_FILES['fileToUpload']['name']; 
$date= date('d-m-Y');
$msg='';

if (filter_has_var(INPUT_POST,'submit'))
{
	
	$secretcode=trim($_POST['secretCode']);
	$message=trim($_POST['Message']);

	if(!empty($secretcode) && !empty($message))
	{
         	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
 		if($check !== false)
		 {
		     $msg= "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		  }
		else
		{
        	$msg= "File is not an image.";
        	$uploadOk = 0;
    		}
		if ($_FILES["fileToUpload"]["size"] > 500000) 
		{
    			$msg= "Sorry, your file is too large.";
    			$uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" )
		{
       	    	  	$msg= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		        $uploadOk = 0;
		}


		if ($uploadOk == 0) 
		{
    			$msg="Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		}
		else
		{
			
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
			{
				
				$msg= "Message Sent";
			}
			else 
			{
        		$msg= "Sorry, there was an error uploading your file.";
    			}
		}

	



				$conn = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
				if ($conn->connect_error)
				{
					 // conection fail
					die ("Connection failed: " . $conn->connect_error);
			 	}

	
			$sql = "INSERT INTO Message (userEmail,messageDate,message,passcode,imagePath) VALUES('$userEmail','$date','$message','$secretcode','$imagePath')";
	
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
						    	

	
			mysqli_close($conn); 
	
	}
	else
	{
		$msg='SecretCode or Message Cannot be Empty';
	}
	
}

else
{

}


?>

<html>
<head>
<title>Secret Message</title> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="main.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--<script type="text/javascript" src= "java.js"></script>-->
</head>
<body>
<ul class ="ul">
	
  <li><a href="messageListPage.php">Messages</a></li>
  <li><a href="index.php" >Logout</a></li>
  
</ul>

<h1>Send Secret Message</h1>
<br>
 

<form  action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"> 
	
<table>
	<?php if($msg != ''):?>
    	<tr><td ></td><td><span class = "err" ><?php echo $msg ?></span></td></tr>
    	<?php endif; ?>
	
	
	<tr><td ></td><td><label = id = "secretCode_err" class= "err" ></label></td></tr>
	<tr><td ><label  > Secret Code:</label> </td><td> <input id="secretCode" type="Send" name="secretCode" size="30"/></td></tr>
	
	<tr><td ></td><td><label = id = "Message_err" class= "err" ></label></td></tr>
	<tr><td >Message: </td><td> <input  id="Message" type="text" class = "Message" name="Message" value="<?=$message?>"  />


	<tr><td>Photo: </td><td> <input type="file"  name="fileToUpload" id="fileToUpload"></td></tr>
	
	<tr><td ></td><td><label = id = Message_err class= "err" ></label></td></tr>
	 
</table>
<br>
<p><button id ="button" class="button" type="submit" name="submit">Send</button>


</form>
<!--<script type="text/javascript" src="mpp.js"></script>-->

</body>
</html>

