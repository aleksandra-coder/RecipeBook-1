<?php
$servername = "127.0.0.1:51111";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "recipebook";
  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   echo " ";
   
?>