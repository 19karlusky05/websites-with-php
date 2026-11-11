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
    <header class="page-header">
        <a href="index.php"><img src="Images/logo.svg" alt="Logo company" class="logo"></a>
        <ul class="nav-list">
            <li><a href="index.php">HOME</a></li>
            <li><a href="movies.php">MOVIES</a></li>
            <li><a href="comingsoon.php">COMING SOON</a></li>
            <li><a href="error.php">PROMOTIONS</a></li>
            <li><a href="error.php">CONTACT US</a></li>
        </ul>
        

        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php endif; ?>


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
    </header>



    
    <section class="wrapper promo-wrapper">
        <h2 class="login-title">TODAY'S PROMOTIONS</h2>

        <div class="promo-section">
            
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
                        <li><a href="#">Modern Slave Statement</a></li>
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