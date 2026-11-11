<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LimeLight Cinema</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                <?php if ($age <18): ?>
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

    <main class="main-content">
                <aside class="sidebar-left">
            <!-- adv content for the future-->
        </aside>

        <section class="wrapper register-wrapper">

            <div class="header-section">
                <a href="login_html.php" class="btn-back">
                    <img src="Images/icons/btn-back.svg" alt="back">
                </a>

                <h2 class="register-title">CREATE A NEW ACCOUNT</h2>
            </div>

            <form class="form-register" method="post" action="register.php">
                <label>Enter New Username:</label>
                <input type="text" name="username">
                <label>Enter New Password:</label>
                <input type="text" name="password">
                <label>Date of Birth :</label>
                <div class="dob-fields">
                    <select name="dob_day" required>
                        <option value="">Day</option>
                        <?php
                        for ($d =1; $d <=31; $d++) {
                            echo "<option value='$d'>$d</option>";
                        }
                        ?>
                    </select>

                    <select name="dob_month" required>
                        <option value="">Month</option>
                        <?php
                        $month = [1=>"January", 2=>"February", 3=>"March", 4=>"April", 5=>"May", 6=>"June", 7=>"July", 8=>"August", 9=>"September", 10=>"October", 11=>"November", 12=>"December",];
                        foreach ($month as $num => $name) {
                            echo "<option value='$num'>$name</option>";
                        }
                        ?>
                    </select>

                    <select name="dob_year" required>
                        <option value="">Year</option>
                        <?php
                        for ($y = date("Y"); $y >= 1950; $y--) {
                            echo "<option value='$y'>$y</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="image" src="Images/icons/btn-submit.png" class="btn-submit" alt="submit">
            </form>

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