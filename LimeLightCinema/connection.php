<?php
// Create connection
$con  = mysqli_connect("localhost","HNDWEBMR18","uTnQexNfWF","HNDWEBMR18");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>