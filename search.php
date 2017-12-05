<?php
 $sJSON = "";
 $sErr = "";

 if (isset($_REQUEST["Add"])) 
       InsertTable(); 
 elseif (isset($_REQUEST["Search"]))
  		SearchTable();	

function InsertTable()
{
  $conn = mysqli_connect("localhost", "sharma3v", "Palak058", "sharma3v");
  if (!$conn) { 
    $sErr = '{"errmsg":"Connection failed. ' . mysqli_connect_error(). '"}';   
    $sJSON = "[". $sErr ."]"; 
    die($sJSON);
  }


  $sql = "INSERT INTO lab_user (email, uname, DOB) 
          VALUES('$_POST[email]', '$_POST[username]', '$_POST[DOB]')";

 
  if (mysqli_query($conn, $sql)) 
  {
    $sErr = '{"errmsg":"A record is successfully added."}';
    
  } 
  else 
  { 
   // if failed to add a new record: 
    $sErr = '{"errmsg":"' . $sql . ' ' . mysqli_error($conn) . '"}';  
   
  }

  $sJSON = "[". $sErr ."]"; 
  echo $sJSON;

  mysqli_close($conn);

}//end of function insertTable()

function SearchTable()
{

  $conn = mysqli_connect("localhost", "sharma3v", "Palak058", "sharma3v");

 if (!$conn) 
 { 
    $sErr = '{"errmsg":"' . mysqli_connect_error() . '"}';
    $sJSON = "[". $sErr ."]"; 
    die($sJSON);
 }


  if ($_POST["Searchname"]=="*")
  {
	$sql = "select * from lab_user ";
	$result = mysqli_query($conn, $sql);
	$sJSON = rJSONData($sql,$result);
	echo $sJSON;
       
  } //end if 
   
   elseif (isset($_POST["Searchname"])&&trim($_POST["Searchname"])!=""&&(isset($_POST["radiobutton"])))
   {
	
       $sql = "select * from lab_user WHERE $_POST[radiobutton] = '$_POST[Searchname]'";
	$result = mysqli_query($conn, $sql);
	$sJSON = rJSONData($sql,$result);
	echo $sJSON;
    
   }
   else
   { 
      mysqli_close($conn);
      $sErr = '{"errmsg":"Please enter what you are searching for."}';
      $sJSON = "[". $sErr ."]"; 
      die($sJSON);
   }//end else

 mysqli_close($conn);

}//end of function searchTable() 



function rJSONData($sql,$result)
{
   $strJSON = "";
   $strErr = "";

   if (mysqli_num_rows($result)==0){
	$strErr = '{"errmsg" : "'. $sql . ' ' . 'There is no matching record found."}';
	$strJSON = "[". $strErr ."]"; 
       echo $strJSON;
   }
   else 
   { 	
	
	$sResp[] =  array();

	while ($row = mysqli_fetch_assoc($result))
	{
	    $sRow["email"]=$row["email"];
	    $sRow["username"]=$row["uname"]; 
	    $sRow["DOB"]=$row["DOB"]; 
	
	    $sResp[] = $sRow;
	}
     //add code here to complete the JSON data retrival. 
     //You can use the given code example from lab12 
     //retrieve email, username, DOB by
     //using php function json_encode() to encode data into JSON format  
	echo json_encode($sResp);

   }}
 

?>

