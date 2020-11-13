<?php
$servername = "127.0.0.1:51010";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "localdb";
  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   echo " ";
   
?>
