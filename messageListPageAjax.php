<?php

session_start();
$userEmail=$_SESSION['userEmail'];
			
$conn= mysqli_connect("localhost","sharma3v","Palak058","sharma3v");
if (!$conn)
{
	exit ();
}

if(!isset($_GET['pa']))
{
$pa="error";
} else {
$pa = $_GET['pa'];
}



$sql = "Select messageId From Message WHERE userEmail=('$userEmail') ORDER BY messageId DESC;";
  if ($result = mysqli_query($conn, $sql))
   {
	  	
	   
	  
	    while ($row = mysqli_fetch_assoc($result)) 
	    {
	    	
		   	 
		   	$messageId=$row["messageId"];

			$sql2 = "SELECT * From Reply WHERE messageId=('$messageId') ORDER BY messageId DESC;";
			

		
			if ($result2 = mysqli_query($conn, $sql2))
			{
				while ($row2 = mysqli_fetch_assoc($result2))
				{	
					$replyId = $row2["replyId"];
					if($replyId>$pa)
					{
					$sRow["replyId"]=$row2["replyId"];				
					$sRow["messageIds"]=$row2["messageId"];
					$sRow["replyMessage"]=$row2["replyMessage"];
					$sRow["replyDate"]=$row2["replyDate"];
					$json[]= $sRow;
					}
				} 		
			}
	    }
	    
		 print json_encode($json);
		  mysqli_free_result($result);

	}

	mysqli_close($conn);
	
	


?>
