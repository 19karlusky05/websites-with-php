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
                    <a href="error.php" class="nav-link">COMING SOON</a>
                </li>
                <li class="nav-item">
                    <a href="error.php" class="nav-link">PROMOTIONS</a>
                </li>
                <li class="nav-item">
                    <a href="error.php" class="nav-link">CONTACT US</a>
                </li>                
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

    <main class="main-content">
                <aside class="sidebar-left">
            <!-- adv content for the future-->
        </aside>

        <section class="wrapper login-wrapper">
            <div class="booking-info">
                <?php
                include("connection.php");

                $user = $_SESSION['username'];
                $age = $_SESSION['age'];
                $clickButton = "";

                if ($_POST['book']) { // this if click on button in info-movie.php
                    $clickButton = $_POST['book'];
                }

                if ($user == "") { // this check if user has login
                    echo"<h3>Attention!</h3>";
                    echo"<p class='rating-text'>You must <a href='login_html.php'>Login</a> to book a ticket</p>";
                }

                else if ($age < 18) {
                    echo"<h3>Access Denied</h3>";
                    echo"<p class='rating-text'>Sorry, you must be 18 or older to buy tickets.</p>";
                }

                else if ($clickButton != "") {

                    // GET booking details
                    $film_id = $_POST['film_id'];
                    $booked_ticket = $_POST['tickets'];

                    // SELECT film from DB
                    $query = "SELECT title, tickets FROM movies WHERE film_id = '$film_id'";
                    $result = mysqli_query($con, $query);

                    if ($row = mysqli_fetch_assoc($result)) {


                        if ($row['tickets'] >= $booked_ticket) {

                            // calculate new stock
                            $newStock = $row['tickets'] - $booked_ticket;

                            // UPDATE tickets
                            $update = "UPDATE movies SET tickets = '$newStock' WHERE film_id = '$film_id'";
                            mysqli_query($con, $update);

                            // show eTicket
                            echo"<div class='info-booking'>";
                                echo"<div class='ticket-card'>";
                                    echo"<div class='ticket-header'>";
                                    echo "<h3>Booking confirmed</h3>";
                            
                                    echo"<div class='info-ticket'>";    
                                        echo "<p><strong>MOVIE: </strong>" .  $row['title'] .  "</p>";
                                        echo "<p><strong>TICKETS BOOKED: </strong>" .  $booked_ticket .  "</p>";
                                        echo "<p class='tickets-left'>Tickets remaining: " .  $newStock . "</p>";
                                    echo"</div>";

                                    echo"<div class='booking-actions'>";
                                        echo"<button onclick='window.print()' class='trailer-btn'>Print Tickets</button>";
                                        echo"<a href='index.php' class='trailer-btn'>Return Home</a>";
                                    echo"</div>";
                                echo"</div>";
                            echo"</div>";


                        } else {
                            echo "<p>Sorry, Not enough tickets available for this movie.</p>";
                        }
                    }
                }

                mysqli_close($con);
                ?>
            </div>
        </section>
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
