<?php
// (1) Create a MySQL database connection:
$conn = mysqli_connect("localhost", "sharma3v", "Palak058", "sharma3v");

// (2) Check connection: 
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE user (
userEmail VARCHAR(50) NOT NULL PRIMARY KEY,
DOB VARCHAR(12),
password VARCHAR(20) NOT NULL,
firstName VARCHAR(50) NOT NULL,
lastName VARCHAR(50) NOT NULL
)";

$sql2 = "CREATE TABLE Message (
messageId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userEmail VARCHAR(50) NOT NULL ,
messageDate VARCHAR(12) NOT NULL,
message VARCHAR(500) NOT NULL,
passcode VARCHAR(12) NOT NULL,
FOREIGN KEY (userEmail) REFERENCES user(userEmail)
)";


$sql3 = "CREATE TABLE Reply (
replyId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
userEmail VARCHAR(50) NOT NULL ,
messageId INT(11) NOT NULL,
replyDate VARCHAR(12) NOT NULL,
replyMessage VARCHAR(500) NOT NULL,
FOREIGN KEY (userEmail) REFERENCES user(userEmail),
FOREIGN KEY (messageId) REFERENCES user(messageId)
)";


if (mysqli_query($conn, $sql)) {
    echo "\nTable user created successfully.\n";
} 
if (mysqli_query($conn, $sql2)) {
    echo "\nTable message created successfully.\n";
} 
if (mysqli_query($conn, $sql3)) {
    echo "\nTable reply created successfully.\n";
} 

else {
    echo "Error creating table: " . mysqli_error($conn);
}
// (4) Always close Database connection:
mysqli_close($conn);
?>
