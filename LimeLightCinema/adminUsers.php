<?php
session_start();
include('connection.php');

$onlyAdmin = $_SESSION['admin'];

if ($onlyAdmin == true) {
} else {
    die("Access denied. Please log in as admin.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php
    $age = $_SESSION['age'];
        if ($age > 0 && $age < 18) {
            echo '<link rel="stylesheet" href="juniorstyle.css">';
        } else {
            echo '<link rel="stylesheet" href="style.css">';
        }
    ?>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body id="top">
    <?php if ($_SESSION['username']) {
        echo"<h2>Welcome, " . $_SESSION['username'] . "!</h2>";
        echo"<a href='logout.php' class='logout-btn'>Logout</a>";
        }
    ?>


    <header class="page-header">
        <nav class="navbar">
            <a href="index.php"><img src="Images/logo.svg" alt="Logo company" class="logo"></a>

            <ul class="nav-list">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="movies.php" class="nav-link">MOVIES</a>
                </li>
                <li class="nav-item">
                    <a href="comingsoon.php" class="nav-link">COMING SOON</a>
                </li>
                <li class="nav-item">
                    <a href="error.php" class="nav-link">PROMOTIONS</a>
                </li>
                <li class="nav-item">
                    <a href="error.php" class="nav-link">CONTACT US</a>
                </li>
                <?php if ($age > 0 && $age < 18): ?>
                    <li class="nav-item">
                        <a href="quiz.php" class="nav-link">QUIZ!GAME</a>
                    </li>
                <?php endif; ?>                 
            </ul>

            <div class="burger-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <div class="header-links">
                <a href="login_html.php">
                    <img 
                        src="<?php 
                        if ($_SESSION['username']) {
                            echo 'Images/icons/icons8-user-in-48-green.png';
                        } else {
                            echo 'Images/icons/icons8-Wuser-out-48.png';
                        }
                        ?>"
                        alt="login session" 
                        class="login-img"
                    >
                </a>
            </div>
        </nav>
    </header>

    <section class="wrapper">
        <section class="admin-table">
        
            <?php
            // ============ UPDATE USER========
            if(isset($_POST['update'])) {

            $id = $_POST['hidden'];
            

            $UpdateQuery = "UPDATE LLC_members SET username='$_POST[username]', password='$_POST[password]', DOB='$_POST[DOB]' WHERE user_id=$id";
            
            if (mysqli_query($con, $UpdateQuery)) {
                echo"<p class='admin-alert'>User updated succesfully!<p>";
            } else {
                echo "ERROR:" . mysqli_error($con);
                }
            }

            //========= DELETE USER ===========
            if(isset($_POST['delete'])) {

                $id= $_POST['hidden'];

            $DeleteQuery = "DELETE FROM LLC_members WHERE user_id=$id";
            
            if (mysqli_query($con, $DeleteQuery)) {
                echo"<p class='admin-alert'>User deleted succesfully!<p>";
            } else {
                echo "ERROR:" . mysqli_error($con);
                }
            }

            //========== ADD USER ==========
            if(isset($_POST['add']))
            {
                $newusername = $_POST["new_username"];
                $newpassword = $_POST["new_password"];
                $newdob = $_POST['new_DOB'];
            
            
                $InsertQuery = "INSERT INTO LLC_members (username, password, DOB) VALUES ('$newusername', '$newpassword', '$newdob')";

                if (mysqli_query($con, $InsertQuery)) {
                echo"<p class='admin-alert'>User added succesfully!</p>";
            } else {
                echo "ERROR: " . mysqli_error($con);
                }
            }
            
            echo "<h2>ADMIN PANEL - MANAGE USERS</h2>";
            echo "<div class='admin-back'>
                <a href='adminPanel.php'>Back to Admin Panel</a>
                </div>";
            
            $result = mysqli_query($con, "SELECT * FROM LLC_members");
            
            echo"<div class='admin-container'>";
                echo "<table border=1 class='manage-table'>
                <tr>
                <th>Username</th>
                <th>Password</th>
                <th>DOB</th>
                <th>Action</th>
                </tr>";
                
                while($row = mysqli_fetch_array($result)) {
                    echo "<form action='adminUsers.php' method='post'>";

                    echo "<tr>";
                    echo "<td><input type='text' name='username' value ='" . $row['username'] . "'></td>";
                    echo "<td><input type='text' name='password' value ='" . $row['password'] . "'></td>";
                    echo "<td><input type='text' name='DOB' value ='" . $row['DOB'] . "'></td>"; //this is the line of the next column
                    echo "<input type='hidden' name='hidden' value ='" . $row['user_id'] . "'>"; //this column is hidden
                    echo "<td>
                            <input type='submit' name='update' value ='update'>
                            <input type='submit' name='delete' value ='delete'>
                        </td>";
                    echo "</tr>";

                    echo "</form>";
                }
                
                // THIS IS TO ADD NEW DATA
                echo "<form method='post' action='adminUsers.php'>";

                echo "<tr class='add-row'>";
                echo "<td><input type='text' name='new_username' placeholder='NEW USERNAME'></td>";
                echo "<td><input type='text' name='new_password' placeholder='NEW PASSWORD'></td>";
                echo "<td><input type='text' name='new_DOB' placeholder='NEW DATE OF BIRTH'></td>";

                echo "<td><input type='submit' value='Add' name='add'></td>";
                echo "</tr>";

                echo "</form>";

                echo"</table>";
            echo"</div>";
            
            
            mysqli_close($con);
            ?>
        </section>

    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">Cookies Policy</a></li>
                        <li><a href="#">Privacy and Legal</a></li>
                        <li><a href="#">Corporate Responsability</a></li>
                        <li><a href="adminPanel.php">Admin Panel</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">F&Q</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Downland</h4>
                    <ul>
                        <li><a href="#">iOS App</a></li>
                        <li><a href="#">Android App</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>