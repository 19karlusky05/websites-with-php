<?php 
include('connection.php'); 

session_start();


$loginUsername = $_POST["loginUsername"];
$loginPassword = $_POST["loginPassword"];

// make sure is not empty
if (empty($_POST["loginUsername"]) || empty($_POST["loginPassword"])) {
    header("Location: errorUser.php");
    exit();
}

//this sql es to check the users
$sql = "SELECT * FROM Angelyn_users WHERE username = '$loginUsername' AND password = '$loginPassword'";
$result = mysqli_query($con, $sql);


// this means mysqli is counting table rows
$count = mysqli_num_rows($result);

//If result matchec $username, table row must be 1 row
if($count==1) {
    
    $row = mysqli_fetch_assoc($result);

    $_SESSION['username'] = $row['username'];

    if ($row['username'] === 'admin') {
        $_SESSION['admin'] = true;
        header("Location: adminPanel.php");
        exit();
    } else {
        $_SESSION['admin'] = false;
    }

//normal users
    $dob = $row['DOB']; 

    list($year, $month, $day) = explode('-', $dob);

    $birthday = mktime(0, 0, 0, $month, $day, $year);
    $difference = time() - $birthday;
    $age = floor($difference / 31556926);

    //para guardar la sesion iniciada
    $_SESSION['age'] = $age;

    //aqui redirige!!
        header("Location: index.php");
        exit();
        } else {
            header("Location: errorUser.php");
            exit();
            }

    //check password and confirm password are matching
    if (empty($loginPassword) != empty($loginPassword)) {
        echo "ERROR: Las datos introducidos no coinciden";
        echo "<a href='login_html.php'>Go to Login</a>";
        mysqli_close($con);
        exit;
    }

?>

