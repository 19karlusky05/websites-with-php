<?php
session_start();
include('connection.php');

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
    <?php if (isset($_SESSION['username'])): ?>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <a href="logout.php" class="logout-btn">Logout</a>
    <?php endif; ?>


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

    <section class="wrapper movies-wrapper">
        <h2 class="login-title">TOP MOVIES</h2>

        <div class="movies-grid">
            <?php
            include('connection.php');

            //Check if user is Junior or Adult
            $age = $_SESSION['age'];
                if ($age < 18) {

                    $query = "SELECT * FROM movies WHERE age_rating < 18 ORDER BY title ASC";

                } else {
                    $query ="SELECT * FROM movies ORDER BY title ASC";
                }

                $result = mysqli_query($con, $query)
                    or die("Couldn't connect with server");
                            
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {   
                    echo "<a href='info-movie.php?id=" . $row['film_id'] . "' class='movie-card'>";

                        $filename = strtolower(str_replace(' ', '-', $row['title'])) . ".jpg";

                        echo "<img src='Images/posters/" . $filename . "' alt='" . $row['title'] . "'>";
                        echo "<h3>" . $row['title'] . "</h3>";
                        echo "<p class='rating-text'>Rating: " . $row['age_rating'] . "</p>";
                    echo "</a>";
                }
                ?>
        </div>
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