<?php
// Create connection
include('connection.php'); 

// to have data
$username = $_POST["username"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$day = $_POST["dob_day"];
$month = $_POST["dob_month"];
$year = $_POST["dob_year"];


//make sure is not empty
if (empty($username) || empty($password) || empty($day) || empty($month) || empty($year)) {
    echo"ERROR: Todos los campos son obligatorios";
    echo "<a href='register_html.php'>Go to Register</a>";
    mysqli_close($con);
    exit;
}

//check password and confirm password are matching
if (empty($password) != empty($confirmPassword)) {
    echo "ERROR: Las contraseñas no coinciden";
    echo "<a href='register_html.php'>Go to Register</a>";
    mysqli_close($con);
    exit;
}

//check if user is +18 years old
if ($year > date("Y") - 18) {
    echo "ERROR: Debes ser mayor de edad para crear una cuenta";
    mysqli_close($con);
    exit;
}

//check if username already exists
$sql = mysqli_query($con, "SELECT * FROM Angelyn_users WHERE username='$username'");
$dob = "$year-$month-$day";

if(mysqli_num_rows($sql) > 0) {
    echo" Username already exists";
}
else {
    
    mysqli_query($con, "INSERT INTO Angelyn_users (username, password, dob) VALUES ('$username', '$password', '$dob')");
    echo "Gracias por crearte una cuenta en Angelyn Confecciones. Descrubre nuestro catalogo aqui";
    echo "<a href='index.php'>Go to Home Page</a>";
}
?>