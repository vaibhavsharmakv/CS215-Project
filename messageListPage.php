<?php
session_start();

$userEmail=$_SESSION['userEmail'];


?>

<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

 </head>
 </html>
 <body>
             <ul class ="ul">
	
  <li><a href="messagePostPage.php">Private Message</a></li>
  <li><a href="index.php" >Logout</a></li>
  
</ul>
          
        
	    		  
	  <div class="chatbox">

		  <div class="chatlogs"> 
		
	<?php
	echo $userEmail;
	?>


		</div>

  
	  </div>	     
			      
		
	
         
<!--<script src="java.js"></script> -->

</body>
</html>﻿