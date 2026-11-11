<?php
// Create connection
include('connection.php'); 

$username = $_POST["username"];
$password = $_POST["password"];
$day = $_POST["dob_day"];
$month = $_POST["dob_month"];
$year = $_POST["dob_year"];

echo($username . " " . $password. " " . $dob); //testing porpuses

//check if username already exists
$sql = mysqli_query($con, "SELECT * FROM LLC_members WHERE username='$username'");
$dob = "$year-$month-$day";

if(mysqli_num_rows($sql) > 0) {
    echo" Username already exists";
}
else {
    mysqli_query($con, "INSERT INTO LLC_members (username, password, dob) VALUES ('$username', '$password', '$dob')");
    echo(", Welcome to LimeLight Cinema! Your new username is successfully registered");
}
?>