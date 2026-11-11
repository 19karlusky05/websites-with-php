<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angelyn Confecciones</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
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
                    <a href="bebes.php" class="nav-link">BEBES</a>
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
                <a href="add-cart.php" class="cart-link">
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


    <!-- Aqui empieza el contenido de la pagina-->
    <section class="hero">
        <a class="hero-image" href="bebes.php">
            <img src="images/content/heros/index-hero-bebe.jpg" alt="Picture of a nino in a winter photoshoot">
        </a>

        <a class="hero-image" href="nina.php">
            <img src="images/content/heros/index-hero-nina.jpg" alt="Picture of a nino in a winter photoshoot">
        </a>

        <a class="hero-image" href="nino.php">
            <img src="images/content/heros/index-hero-nino.jpg" alt="Picture of a nino in a winter photoshoot">
        </a>
    </section>

    <!--Aqui empieza las tarjetas de informacion de pedidos. Cards containers-->
    <section class="card-container">
        <div class="card-delivery">
        <img src="images/icons/icons8-secure-payment-48.png" alt="Icon of security check">

        <h5 class="card-heading">Pago seguro</h5>
        <div class="card-text">
            <p>100% confiable</p>
        </div>
    </div>

    <div class="card-delivery">
        <img src="images/icons/icons8-delivery-time.png" alt="A truck with a clock time">

        <h5 class="card-heading">Envíos en 48h</h5>
        <div class="card-text">
            <p>Envío gratis a partir de €49</p>
        </div>
    </div>

    <div class="card-delivery">
        <img src="images/icons/icons8-return-box-48.png" alt="a box with an circle arrow">
        <h5 class="card-heading">Devolución gratis</h5>
        <div class="card-text">
            <p>30 días de devolución</p>
        </div>  
    </div>

    <div class="card-delivery">
        <img src="images/icons/icons8-join-user.png" alt="Three body shapes and plus icon">

        <h5 class="card-heading">Únete a nuestra comunidad</h5>
        <div class="card-text">
            <p>15% descuento para nuevos usuarios</p>
        </div>
    </div>
    </section>

    <!-- This is for tailoring section. A tu medida-->
    <section class="tailoring">
        <div class="info-tailoring">
            <img src="images/content/heros/index-hero-tailor.png" alt="imagen de maniqui">

            <div class="info-pane-text">
                <h3>A tu medida</h3>

                <p>
                ¿Se acerca ese dia tan especial y necesitas un traje para su Primera Comunión? 
                Tenemos lo que buscas. Dentro de nuestro catálogo de vestidos de comunión, puedes personalizar tu vestido para que ese día sea aún más especial. 
                Contáctanos y te enviaremos todos los detalles. <strong>Los vestidos serán confeccionados en 3 meses después de la primera cita.</strong>
                ¡Resérvalo con tiempo!
                </p>

                <a href="tailoring.php" class="button">Contáctanos</a>
            </div>
        </div>
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
                    <form action="newsletter.php" method="POST">
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

    <!-- COOKIES BAR -->
    <a href="#" onclick="document.cookie='cookiebar=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/'; setupCookieBar(); return false;">Click here to revoke the Cookie consent</a>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=es&customize=1&tracking=1&always=1&top=1&showNoConsent=1"></script>

    <script src="script.js"></script>
    
</body>
</html>