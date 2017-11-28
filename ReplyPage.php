<?php
session_start();

$messageId=$_SESSION['messageId'];



	# code...
$replyDate= date('d-m-Y');
$replyMessage=trim($_POST['Reply']);


			$conn = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
			if ($conn->connect_error)
			{
				 // conection fail
				die ("Connection failed: " . $conn->connect_error);
		 	}
			else
			{
	
			$sql = "Select message,messageDate,imagePath From Message WHERE messageId=('$messageId')";
	
			$result = $conn->query($sql);
			$row=$result->fetch_assoc();
			   	
			$message=$row["message"];
			$messageDate=$row["messageDate"];
				 
			$imagePath=$row["imagePath"];
			mysqli_close($conn); 
				

			
			
				if (filter_has_var(INPUT_POST,'send'))
				{	
					$conn1 = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
					if ($conn1->connect_error)
					{
						 // conection fail
						die ("Connection failed: " . $conn1->connect_error);
				 	}
					$sql1 = "Select userEmail From Message  WHERE messageId=('$messageId')";
					$result1 = mysqli_query($conn1, $sql1);
					$row1 = mysqli_fetch_assoc($result1);
					$userEmail=$row1["userEmail"];
					
					
					mysqli_close($conn1); 
					
					//conn2
					$conn2 = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
					if ($conn2->connect_error)
					{
						 // conection fail
						die ("Connection failed: " . $conn2->connect_error);
				 	}
		
					$sql2 = "INSERT INTO Reply (userEmail,messageId,ReplyDate,replyMessage) VALUES('$userEmail','$messageId','$replyDate','$replyMessage') ";
					$result2 = mysqli_query($conn2, $sql2);
					$row2 = mysqli_fetch_assoc($result2);
					
					mysqli_close($conn2); 
					
					//conn3
					
					
					
					

					
				}
			

					$conn3 = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
					

					if ($conn3->connect_error)
					{
						 // conection fail
						die ("Connection failed: " . $conn2->connect_error);
				 	}
					$sql3 = "Select replyMessage From Reply  WHERE messageId=('$messageId') ORDER BY replyDate DESC";
					$result3 = mysqli_query($conn3, $sql3);
					$row3 = mysqli_fetch_assoc($result3);
					mysqli_close($conn3); 
					
				if (filter_has_var(INPUT_POST,'delete')) 
				{
					$conn4 = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
					

					if ($conn4->connect_error)
					{
						 // conection fail
						die ("Connection failed: " . $conn2->connect_error);
				 	}
					$sql4 = "DELETE FROM Message WHERE messageId=('$messageId')";
					$sql5 = "DELETE FROM Reply WHERE messageId=('$messageId')";
					if ($conn4->query($sql4) === TRUE) {
					    
					}
					if ($conn4->query($sql5) === TRUE) {
					    
					}
					mysqli_close($conn4); 

				}
	

		
			}



?>


<!DOCTYPE html>
<html>
<head>
    <title>Secret Message</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" type="text/css" href="main.css">
 <!--   <script type="text/javascript" src= "java.js"></script>
-->

 </head>
 </html>
 <body>
              <ul class ="ul">
  <li><a href="index.php">Home</a></li>
  
  
</ul>
<header>
<table>
<tr>
<td>

<td>
<h1>Secret Message</h1></td>
</tr>
</table>
</header>
<div class="chatbox">  

          <table class="chatlogs">
		
 		 <?php if($imagePath != 'upload/'):?>
		  <tr><td > Image :<img src="<?=$imagePath?>" width="130" height="130"/> </td><td>
		 <?php endif; ?>
		  <tr><td > Message: <?=$message?> </td><td>
		  <tr><td > Time : <?=$messageDate?></td><td>
		 
          </table>

	 <table class="chatlogs">
	<?while($row3 = mysqli_fetch_assoc($result3)){?>
	 		 <?php if($imagePath != 'upload/'):?>
			  <tr><td > Image :<img src="<?=$imagePath?>" width="130" height="130"/> </td><td>
			 <?php endif; ?>
			  <tr><td > Reply: <?=$row3["replyMessage"]?> </td><td>
			  <tr><td > Time : <?=$messageDate?></td><td>
	<?php } ?>
		  </table>

      </div>

      
<br>





<form  action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"> 
       

         
          <table>
          <tr><td ></td><td><label = id = "Message_err" class= "err" ></label></td></tr>
          <tr><td >Reply: </td><td> <input  id="Message" type="text" class = "Message" name="Reply"  />
          </table>
          <p>
          <button id="button" class="button" type="submit" name="send">Send</button>
          <button id="del" class="button" type="submit" name="delete">Delete</button>
          <tr><td ></td><td><label = id = "alert_err" class= "err" ></label></td></tr>
          </p>
</form > 
<!-- script type="text/javascript" src="messageReply.js"></script>
-->

</body>
</html>﻿
