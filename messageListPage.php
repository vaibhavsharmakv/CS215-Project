<?php




	session_start();
	
	if (!isset($_SESSION["userEmail"])) {
		header("Location: index.php");
		exit();
	} else 
	{
	
		$userEmail=$_SESSION['userEmail'];
	
		$conn = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
		if ($conn->connect_error)
		{
			 // conection fail
			die ("Connection failed: " . $conn->connect_error);
	 	}
		else
		{
	
			$sql = "Select messageId,message,messageDate,imagePath From Message WHERE userEmail=('$userEmail') ORDER BY messageId DESC;";

			$result = $conn->query($sql);
			
			$sql1 = "Select messageId From Message WHERE userEmail=('$userEmail') ORDER BY messageId DESC;";
			
			$result1 = $conn->query($sql1);
				
			
		}
	
		
		
	
	}
	

?>

<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" src= "java.js">

</script>

 </head>
 </html>

 <body  >
             <ul class ="ul">
	
  <li><a href="messagePostPage.php">Private Message</a></li>
  <li><a href="index.php" >Logout</a></li>

  
</ul>	
 <table><tr><td > <button id="refresh" class="button" type="submit" name="refresh" value= "ON">Automatic Refresh:ON</button></td><td>
			      </table>
<tr><td ></td><td><label = id = "refresh_err" class= "err" ></label></td></tr>
  </label>  
	    		  
	

		  
		<?while($row = mysqli_fetch_assoc($result)):?>
			<div class="chatbox">

			 <?php
			$image= $row["imagePath"];
			echo $row["imagePath"];
			if( $image != 'upload/' ):?>
			<div class="chatlogs"> 
			
			  <table class="chatlogs">
			  <tr><td > Image :<img src="<?=$row['imagePath'] ?>" width="130" height="130"/> </td><td><br>
			 <?php endif; ?>
			<tr><td > Message: <?=$row["message"]?>  </td><td>
				<br>
			  <tr><td > Time : <?=$row["messageDate"]?></td><td>
			  	<br>
			
			<?php
			
			$messageId=$row["messageId"];
			
			$sql2 = "SELECT replyMessage,replyDate,replyId From Reply WHERE messageId=('$messageId') ORDER BY messageId DESC;";
			$result2 = $conn->query($sql2);
			$sql3 = "SELECT replyMessage,replyDate,replyId From Reply WHERE messageId=('$messageId') ORDER BY messageId DESC;";
			$result3 = $conn->query($sql3);
			$row3 = mysqli_fetch_assoc($result3);
			$r = $row3["replyId"];
			?>
			<input type = "hidden" id="replyId" name = "replyId" value ="<?=$r?>" > 
			<div id = "<?=$messageId?>" >   </div>
			<?
			
			while ($row2 = mysqli_fetch_assoc($result2)) 
			{
				
				?>
				
				<tr><td > Reply: <?=$row2["replyMessage"]?>  </td><td>
					<br>
			  <tr><td >REPLY Time : <?=$row2["replyDate"]?></td><td>
			  	<br>
			
			  	
			
			 <? 	
			}?>
			

			
			<?
			
			if (isset($_POST["delete"]) ){
					$conn4 = new mysqli("localhost", "sharma3v", "Palak058", "sharma3v");
					

					if ($conn4->connect_error)
					{
						 // conection fail
						die ("Connection failed: " . $conn2->connect_error);
				 	}
					$sql4 = "DELETE FROM Message WHERE messageId=('".$_POST["delete_id"]."');";
					$sql5 = "DELETE FROM Reply WHERE messageId=('".$_POST["delete_id"]."');";
					if ($conn4->query($sql4) === TRUE) {
					    
					}
					if ($conn4->query($sql5) === TRUE) {
					    
					}
					mysqli_close($conn4); 

				}

			?>
			
			<form  action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
			 <table >
			<input type = "hidden" name = "delete_id" value ="<?=$messageId?>" >
			<tr><td > <button id="del" class="button" method="POST" type="submit" name="delete">Delete</button></td><td>
			
			
			</table>
			</form>
		
		
	
	
		  </table>
	
		</div>
		 </div>
<?php endwhile; ?>
  
	
 
		<?php 
		mysqli_close($conn);
		mysqli_close($conn1);  			
		?>
	<script type="text/javascript" src="listPage.js"></script>
      <script>
	var myVar = setInterval(function(){ download() }, 5000);	
</script>   


</body>
</html>﻿
