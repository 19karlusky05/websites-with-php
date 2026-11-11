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
    <title>Admin Panel - Users Angelyn Confecciones</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body id="top">
    <!-- Greeting message -->
    <?php 
    if (isset($_SESSION['username']) && !isset($_SESSION['greeting'])) {
        $username = $_SESSION['username'];
        echo "<script>
            alert('Bienvenid@, $username!');
            </script>";
        $_SESSION['greeting'] = true;
        }
    ?>

    <header class="page-header">
        <nav class="navbar">
            <a href="index.php"><img src="images/content/angelyn-logo.png" alt="Logo company" class="logo"></a>

            <ul class="nav-list">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">INICIO</a>
                </li>
                <li class="nav-item">
                    <a href="bebes.php" class="nav-link">BEBÉS</a>
                </li>
                <li class="nav-item">
                    <a href="nina.php" class="nav-link">NIÑA</a>
                </li>
                <li class="nav-item">
                    <a href="nino.php" class="nav-link">NIÑO</a>
                </li>
                <li class="nav-item">
                    <a href="tailoring.php" class="nav-link">A TU MEDIDA</a>
                </li>            
            </ul>

            <!--Login button-->
            <div class="account-container">
                <div class="dropdown">
                    <a href="#" class="account-link dropdown-toggle">
                        <i class="fa-solid fa-user user-icon"></i>
                        CUENTA
                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                    </a>
    
                    <ul class="dropdown-menu">
                        <li><a href="login_html.php" class="dropdown-link">Iniciar Sesión</a></li>
                        <li><a href="register_html.php" class="dropdown-link">Registrarse</a></li>
                        <!-- AGREGAR PHP CONNECTION<li><a href="userProfile.php" class="dropdown-link">Mi cuenta</a></li>-->
                        <li>
                            <a href="logout.php" class="dropdown-link">
                            <i class="fa-solid fa-arrow-right-from-bracket" style="color: rgb(0, 0, 0);"></i>
                            Cerrar Sesion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Cart button -->
            <div class="cart-container">
                <a href="cart.php" class="cart-link">
                    <i class="fa-solid fa-cart-shopping cart-icon"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>

            <div class="burger-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <section class="wrapper">
        <section class="admin-table">
        
            <?php
            //========= DELETE USER ===========
            if(isset($_POST['delete'])) {

                $id= $_POST['hidden'];

            $DeleteQuery = "DELETE FROM Angelyn_email WHERE email_id=$id";
            
            if (mysqli_query($con, $DeleteQuery)) {
                echo"<p class='admin-alert'>Email deleted succesfully!<p>";
            } else {
                echo "ERROR:" . mysqli_error($con);
                }
            }

            //========== ADD EMAIL ==========
            if(isset($_POST['add']))
            {
                $email_id = $_POST['new_email'];
            
            
                $InsertQuery = "INSERT INTO Angelyn_email (email_user) VALUES ('$email_id')";

                if (mysqli_query($con, $InsertQuery)) {
                echo"<p class='admin-alert'>Email added succesfully!</p>";
            } else {
                echo "ERROR: " . mysqli_error($con);
                }
            }
            
            echo "<h2>ADMIN PANEL - MANAGE ANGELYN NEWSLETTER EMAILs</h2>";
            echo "<div class='admin-back'>
                <a href='adminPanel.php'>Back to Admin Panel</a>
                </div>";
            
            $result = mysqli_query($con, "SELECT * FROM Angelyn_email");
            
            echo"<div class='admin-container'>";
                echo "<table border=1 class='manage-table'>
                <tr>
                <th>Email</th>
                <th>Action</th>
                </tr>";
                
                while($row = mysqli_fetch_array($result)) {
                    echo "<form action='adminNewsletter.php' method='post'>";

                    echo "<tr>";
                    echo "<td><input type='text' name='email' value ='" . $row['email_user'] . "'></td>";
                    echo "<input type='hidden' name='hidden' value ='" . $row['email_id'] . "'>"; //this column is hidden
                    echo "<td class='action-buttons'>
                            <input type='submit' name='update' value ='update' class='btn-update'>
                            <input type='submit' name='delete' value ='delete' class='btn-delete'>
                        </td>";
                    echo "</tr>";

                    echo "</form>";
                }
                
                // THIS IS TO ADD NEW DATA
                echo "<form method='post' action='adminNewsletter.php'>";

                echo "<tr class='add-row'>";
                echo "<td><input type='text' name='new_email' placeholder='NEW EMAIL'></td>";

                echo "<td><input type='submit' value='Add' name='add' class='btn-add-admin'></td>";
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
                    <h2>ESTAMOS EN</h2>
                    <ul>
                        <li>Calle Bravo Murillo, 255</li>
                        <li>28020 MADRID</li>
                        <li>ESPAÑA</li>
                        <li><a href="https://www.google.co.uk/maps/place/C.+de+Bravo+Murillo,+255,+Tetu%C3%A1n,+28020+Madrid,+Spain/@40.4592587,-3.7026804,17z/data=!3m1!4b1!4m6!3m5!1s0xd422906d725b573:0x7ab598a25d93e52!8m2!3d40.4592587!4d-3.7001055!16s%2Fg%2F11c43xdxp4?entry=ttu&g_ep=EgoyMDI2MDMxOC4xIKXMDSoASAFQAw%3D%3D">ver mapa</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h2>HORARIO</h2>
                    <ul>
                        <li>LUNES A VIERNES</li>
                        <li>10:00h a 19:00h</li>
                        <br/>
                        <li>Telf. +34 650 77 44 11</li>
                    </ul>
                </div>

                <div class="newsletter-container">
                    <h2>Suscríbete a nuestro Newsletter</h2>
                    <form action="procesar_suscripcion.php" method="POST">
                        <input type="email" name="email" placeholder="Tu correo electrónico" required>
                        <button type="submit">Suscribirme</button>
                    </form>
                </div>

                <div class="footer-links">
                    <h2>SÍGUENOS</h2>

                    <div class="social-icons">
                        <a href="https://www.facebook.com/angelynconfecciones" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/angelyn.confecciones/" target="blank"><i class="fab fa-instagram"></i></a>
                    </div>
                    
                    <ul>
                        <li><a href="plp.html">Politica Legal de Privacidad</a></li>
                        <li><a href="tyc.html">Terminos y Condiciones</a></li>
                        <li><a href="adminPanel.php">Admin Panel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="script.js"></script>

</body>
</html>