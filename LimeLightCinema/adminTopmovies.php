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
                <?php if ($age > 0 && $age < 18): ?> <!-- show for juniors only --> 
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

    <section class="admin-table">
        <?php
        // ======== UPDATE MOVIE ========
        if(isset($_POST['update'])) {

            $film_id = $_POST['hidden'];


            $UpdateQuery = "UPDATE movies
                SET title='$_POST[title]', img='$_POST[img]', trailer_url='$_POST[trailer_url]', director='$_POST[director]',
                    tickets='$_POST[tickets]', description='$_POST[description]', release_date='$_POST[release_date]',
                    age_rating='$_POST[age_rating]', genre='$_POST[genre]'
                
                WHERE film_id = '$film_id'"; 
            

            if (mysqli_query($con, $UpdateQuery)) {
                echo"<p class='admin-alert'>Movie updated succesfully!</p>";
            } else {
                echo "ERROR:Sorry, we could not update $film_id" . mysqli_error($con);
            }
        }

        // ======= DELETE MOVIE ==========
        if(isset($_POST['delete'])) {

            $film_id = $_POST['film_id'];

            $DeleteQuery = "DELETE FROM movies WHERE film_id = $film_id";
            
            if (mysqli_query($con, $DeleteQuery)) {
                echo"<p class='admin-alert'>Movie deleted succesfully!</p>";
            } else {
                echo "ERROR: " . mysqli_error($con);
            }
        }

        // =========== ADD MOVIE ============
        if(isset($_POST['add']))
        {
            $title = $_POST['new_title'];
            $img = $_POST['new_img'];
            $trailer_url = $_POST['new_trailer_url'];
            $director = $_POST['new_director'];
            $tickets = $_POST['new_tickets'];
            $description = $_POST['new_description'];
            $release_date = $_POST['new_release_date'];
            $age_rating = $_POST['new_age_rating'];
            $genre = $_POST['new_genre'];


            $InsertQuery = "INSERT INTO movies (title, img, trailer_url, director, tickets, description, release_date, age_rating, genre)
                            VALUES ('$title', '$img', '$trailer_url', '$director', '$tickets', '$description', '$release_date', '$age_rating', '$genre')";
            
            if (mysqli_query($con, $InsertQuery)) {
                echo"<p class='admin-alert'>Movie added succesfully!</p>";
            } else {
                echo "ERROR: " . mysqli_error($con);
            }
        }



        echo "<h2>ADMIN PANEL - MANAGE TOP MOVIES</h2>";
        echo "<div class='admin-back'>
                <a href='adminPanel.php'>Back to Admin Panel</a>
                </div>";

        $result = mysqli_query($con, "SELECT * FROM movies ORDER BY title ASC");

        echo"<div class='admin-container'>";
            echo "<table border='1' class='manage-table'>
            <tr>
            <th>Title</th>
            <th>Img</th>
            <th>Trailer</th>
            <th>Director</th>
            <th>Tickets</th>
            <th>Description</th>
            <th>Release Date</th>
            <th>Age Rating</th>
            <th>Genre</th>
            <th>Action</th>
            </tr>";

            while($row = mysqli_fetch_array($result)) {
                echo "<form action='adminTopmovies.php' method='post'>";

                echo "<tr>";
                echo "<td><input type='text' name='title' value ='" . $row['title'] . "'></td>";
                echo "<td><input type='text' name='img' value ='" . $row['img'] . "'></td>";
                echo "<td><input type='text' name='trailer_url' class='expand-input' value ='" . $row['trailer_url'] . "'></td>";
                echo "<td><input type='text' name='director' value ='" . $row['director'] . "'></td>";
                echo "<td><input type='text' name='tickets' value ='" . $row['tickets'] . "'></td>";
                echo "<td><input type='text' name='description' class='expand-input' value ='" . $row['description'] . "'></td>";
                echo "<td><input type='text' name='release_date' value ='" . $row['release_date'] . "'></td>";
                echo "<td><input type='text' name='age_rating' value ='" . $row['age_rating'] . "'></td>";
                echo "<td><input type='text' name='genre' value ='" . $row['genre'] . "'></td>";
                echo "<input type='hidden' name='film_id' value ='" . $row['film_id'] . "'>"; //this column is hidden
                
                echo "<td>
                        <input type='submit' name='update' value ='update'>
                        <input type='submit' name='delete' value ='delete'>
                    </td>";
                echo "</tr>";

                echo "</form>";
            }

            // THIS IS TO ADD NEW DATA
            echo "<form action='adminTopmovies.php' method='post'>";
            
            echo "<tr class='add-row'>";
            echo "<td><input type='text' name='new_title' placeholder='TITLE'></td>";
            echo "<td><input type='text' name='new_img' placeholder='IMAGE'></td>";
            echo "<td><input type='text' name='new_trailer_url' class='expand-input' placeholder='URL TRAILER'></td>";
            echo "<td><input type='text' name='new_director' placeholder='DIRECTOR'></td>";
            echo "<td><input type='text' name='new_tickets' placeholder='TICKETS'></td>";
            echo "<td><input type='text' name='new_description' class='expand-input' placeholder='DESCRIPTION'></td>";
            echo "<td><input type='text' name='new_release_date' placeholder='RELEASE_DATE'></td>";
            echo "<td><input type='text' name='new_age_rating' placeholder='AGE_RATING'></td>";
            echo "<td><input type='text' name='new_genre' placeholder='GENRE'></td>";
            
            echo "<td><input type='submit' value='add' name='add'></td>";
            echo "</tr>";

            echo "</form>";

            echo"</table>";
        echo"</div>";



        mysqli_close($con);
        ?>
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