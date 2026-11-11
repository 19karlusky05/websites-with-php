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
                    <a href="comingsoon.php" class="nav-link">COMING SOON</a>
                </li>
                <li class="nav-item">
                    <a href="promotion.php" class="nav-link">PROMOTIONS</a>
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

    <section class="wrapper quiz-wrapper">
        <div class="quiz-container">
                <header class="quiz-header">
                    <h1>MOVIE QUIZ</h1>
                    <p>Hello, <?php echo $_SESSION['username']?>! Show how much you know about movies</p>
                </header>

                <form id="quizForm">
                    <div class="quiz-card">
                        <p class="question-text">1. Which Disney Princess sings "Once Upon a Dream"?</p>
                        <div class="options">
                            <label class="option-label"><input type="radio" name="q1" value="0"> BRAVE</label>
                            <label class="option-label"><input type="radio" name="q1" value="1"> AURORA</label> <!--correct ans-->
                            <label class="option-label"><input type="radio" name="q1" value="0"> SNOW WHITE</label>
                        </div>
                    </div>

                    <div class="quiz-card">
                        <p class="question-text">2. What is the name of Andy's neighbor in Toy Story?</p>
                        <div class="options">
                            <label class="option-label"><input type="radio" name="q2" value="1"> SID</label> <!--correct ans-->
                            <label class="option-label"><input type="radio" name="q2" value="0"> MARK</label>
                            <label class="option-label"><input type="radio" name="q2" value="0"> DANYAL</label>
                        </div>
                    </div>

                    <div class="quiz-card">
                        <p class="question-text">3. What is the name of Ariel and Prince Eric's daughter?</p>
                        <div class="options">
                            <label class="option-label"><input type="radio" name="q3" value="0"> PRINCESS BELLA</label>
                            <label class="option-label"><input type="radio" name="q3" value="1"> PRINCESS MELODY</label> <!--correct ans-->
                            <label class="option-label"><input type="radio" name="q3" value="0"> PRINCESS CLAIRE</label>
                        </div>
                    </div>

                    <div class="quiz-footer">
                        <button type="button" class="submit-btn" onclick="checkQuiz()">Finish Quiz</button>
                        <div id="quiz-result"></div>
                    </div>
                </form>
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