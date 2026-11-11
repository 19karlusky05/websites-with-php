<?php
session_start();
include('connection.php');


$id = $_GET['id'];

$query = "SELECT * FROM movies WHERE film_id = $id LIMIT 1";
$result = mysqli_query($con, $query)
    or die("Error 404! Return page");

$movie = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LimeLight Cinema</title>
    <?php
    $age = $_SESSION['age'];
        if ($age > 0 && $age < 18) {
            echo '<link rel="stylesheet" href="juniorstyle.css">';
        } else {
            echo '<link rel="stylesheet" href="style.css">';
        }
    ?>
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
                        src="<?php echo isset($_SESSION['username'])
                        ? 'Images/icons/icons8-user-in-48-green.png'  // este imagen si la session ha sido iniciada 
                        : 'Images/icons/icons8-Wuser-out-48.png';
                        ?>"
                        alt="login session" 
                        class="login-img"
                    >
                </a>
            </div>
        </nav>
    </header>



    <!--WEBSITE BODY CONTENT-->
    <main class="main-content">
        <aside class="sidebar-left">
            <!-- adv content for the future-->
        </aside>

        <section class="wrapper movie-details-wrapper">
            <div class="movie-container">
                <div class="movie-image">
                    <img 
                        src="Images/posters/<?php echo strtolower(str_replace(' ', '-', $movie['title'])); ?>.jpg"
                        alt="<?php echo $movie['title']; ?>"
                    >

                    <!-- trailer button / DOES NOT WORK -->
                    <button type='button' class='trailer-btn' data-trailer="<?php echo $movie['trailer_url']; ?>">
                        Watch trailer
                    </button>
                    
                </div>

                <div class="movie-info">
                    <?php
                    include('connection.php');

                    $id = $_GET['id'];
                    $query = "SELECT * FROM movies WHERE film_id = $id";

                    $result = mysqli_query($con, $query)
                    or die ("couldn't run query");


                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                        echo"<div class='info-details'>";
                            echo"<h3 class='movie-title'>" . $row['title'] . "</h3>";
                            echo"<p><strong>Director: </strong> " . $row['director'] . "</p>";                        
                            echo"<p><strong>Description: </strong> " . $row['description'] . "</p>";
                            echo"<p><strong>Realese date: </strong> " . $row['release_date'] . "</p>";
                            echo"<p><strong>Age rating: </strong> " . $row['age_rating'] . "</p>";
                            echo"<p><strong>Genre: </strong> " . $row['genre'] . "</p>";
                        echo"</div>";
                    }

                    echo"<hr/>";

                    //sessions table
                    echo"<div class='sessions'>";
                    echo"EVERY WED - 18:00H";
                    echo"</div>";
                    echo"<div class='sessions'>";
                    echo"EVERY THUR - 18:00H, 21:00H";
                    echo"</div>";
                    echo"<div class='sessions'>";
                    echo"EVERY FRI - 18:00, 21:00H";
                    echo"</div>";
                    echo"<div class='sessions'>";
                    echo"EVERY SAT - 12:00H, 17:00H, 19:00H, 21:00H";
                    echo"</div>";
                    ?>


                    <form method="post" action="booking.php">
                        <div class="form-login">
                            <label><strong>Number of Tickets</strong></label>
                            <input type="number" class="form-tickets" name="tickets">
                        </div>
                        <input type="hidden" class="form-tickets" name="film_id" value="<?php echo $id; ?>">
                        <input type="submit" name="book" value="BOOK" class="btn-submit">
                    </form>
                </div>

            </div>
        </section>

        <aside class="sidebar-right">
           <!--adv content for the future-->
        </aside>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">Cookies Policy</a></li>
                        <li><a href="#">Privacy and Legal</a></li>
                        <li><a href="#">Corporate Responsability</a></li>
                        <li><a href="#">Modern Slave Statement</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="adminPanel.php">Admin Panel</a></li>
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

<div id="trailer-modal" class="trailer-modal">
    <div class="trailer-modal-content">
        <span class="trailer-close">&times;</span>
        <iframe id="trailer-iframe" src="" allowfullscreen></iframe>
    </div>
</div>


    <script src="script.js"></script>
</body>
</html>