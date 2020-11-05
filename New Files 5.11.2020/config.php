<?php
$servername = "127.0.0.1:51111";
$dbusername = "azure";
$dbpassword = "6#vWHD_$";
$dbname = "recipebook";
  // Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   echo " ";
   
?>
