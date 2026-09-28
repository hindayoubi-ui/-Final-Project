<?php 
$sername="localhost"; 
$username="root"; 
$password=""; 
$dbname="ha_homestore"; 
 
//create connection 
$conn=new mysqli($sername,$username,$password,$dbname); 
 
//check connection 
if($conn-> connect_error){ 
    die ("connection failed :" . $conn-> connect_error); 
}

//echo "Connected successfully";
?>