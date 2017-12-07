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
	echo ("error");exit ();
}

if(!isset($_GET['pa']))
{
$pa="";
} else {
$pa = $_GET['pa'];
}


$sql = "SELECT passcode FROM Message WHERE passcode like '$pa%' LIMIT 5";



if ($result = mysqli_query ($conn, $sql)) 
{
	 // $json = array("users" => array());
	  while ($row = mysqli_fetch_assoc($result))
	 {
	   // $json["users"][] = $row;
	  } 
	  //print json_encode($json);
	  //mysqli_free_result($result);
} 
	generateRandomString();
	mysqli_close($conn);
	

	function generateRandomString()
 {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $pa = $_GET['pa'];
    $randomString = $pa;
    $currentpasslength = strlen($pa);
    $json = array("users" => array());
	for($x = 0; $x < 5; $x++ )
	{
	    for ($i = 0; $i < (8 - $currentpasslength ); $i++) 
		{
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$json["users"][] = $randomString;
		$randomString = $pa;
	}
	print json_encode($json);
}
?>
