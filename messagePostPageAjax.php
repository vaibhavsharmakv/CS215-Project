<?php
// take string from xmlhtpp request 

// generate a passcode using random funciton

// check in the data base if that passcode already exist 
	// open connection with database
	// send query 
	// add it into json object 
	//encode json object 
	
$conn= mysqli_connect("localhost","sharma3v","Palak058","sharma3v");
if (!$conn)
{
	exit ();
}

if(!isset($_GET['pa']))
{
$pa="";
} else {
$pa = $_GET['pa'];
}


$sql= "SELECT passcode FROM Message WHERE passcode like '$pa%'";




if ($result = mysqli_query ($conn, $sql)) {
	  $json = array("users" => array());
	  while ($row = mysqli_fetch_assoc($result)) {
	    $json["users"][] = $row;
	  } 
	  print json_encode($json);
	  mysqli_free_result($result);
	} 
	
	mysqli_close($conn);
	


?>
