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
    $age = $_SESSION['age']; //check if user is and adult or junior
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
                    <a href="promotion.php" class="nav-link">PROMOTIONS</a>
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


    <!--WEBSITE BODY CONTENT-->
    <main class="main-content">
        <aside class="sidebar-left">
            <!-- adv content for the future-->
        </aside>
            
        <section class="wrapper"> 
            <div class="carrusel-container">
                <div class="movies-carrusel">
                    <div class="carrusel">
                        <div class="slide active">
                            <img src="Images/banner-movie.jpg" alt="banner movie 1">
                        </div>
                        
                        <div class="slide">
                            <img src="Images/banner-movie-2.jpg" alt="banner movie 2">
                        </div>

                        <div class="slide">
                            <img src="Images/banner-movie-3.jpg" alt="banner movie 3">
                        </div>
                    </div>
                </div>   

                <button class="carrusel-arrow left-arrow">
                    <img src="Images/icons/btn-back.svg" alt="back">
                </button>

                <button class="carrusel-arrow right-arrow">
                    <img src="Images/icons/btn-next.svg" alt="next">
                </button>
            </div>
        

            <section class="now-showing">
                <div class="now-showing-header">
                    <h2>NOW SHOWING</h2>
                    <a href="movies.php" class="view-all">VIEW ALL</a>
                </div>

                <div class="movies-grid">
                    <?php
                    include('connection.php');

                    $query = "SELECT * FROM movies LIMIT 4"; //numeros de pelis que quiero mostrar
                    $result = mysqli_query($con, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $filename = strtolower(str_replace(' ', '-', $row['title'])) . ".jpg";

                        echo "<a href='info-movie.php?id={$row['film_id']}' class='movie-card'>";
                        echo "<img src='Images/posters/$filename' alt='{$row['title']}'>";
                        echo "<h3>{$row['title']}</h3>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>
        
        
            <section class="coming-soon">
                <div class="now-showing-header">
                    <h2>COMING SOON</h2>
                    <a href="comingsoon.php" class="view-all">VIEW ALL</a>
                </div>

                <div class="movies-grid">
                    <?php
                    include('connection.php');

                    $query = "SELECT * FROM coming_soon LIMIT 4"; //numeros de pelis que quiero mostrar
                    $result = mysqli_query($con, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $filename = strtolower(str_replace(' ', '-', $row['title'])) . ".jpg";

                        echo "<a href='info-comingsoon.php?id={$row['film_id']}' class='movie-card'>";
                        echo "<img src='Images/posters/comingsoon/$filename' alt='{$row['title']}'>";
                        echo "<h3>{$row['title']}</h3>";
                        echo "</a>";
                    }
                    ?>
                </div>
            </section>
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