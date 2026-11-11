<?php
session_start();
include('connection.php');


$id = $_GET['id'];

$query = "SELECT * FROM Angelyn_products WHERE item_id = $id LIMIT 1";
$result = mysqli_query($con, $query)
    or die("Error 404! Return page");

$product = mysqli_fetch_assoc($result);
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

    <section class="wrapper item-details-wrapper">
            <div class="product-container">
                <div class="product-image">
                    <?php
                    echo "<img src='images/content/bebes/" . $product['item_img'] . "' alt='" . $product['item_name'] . "'>";
                    ?>
                </div>

                <div class="item-info"> <!-- ITEM INFO PER PAGES -->
                    <?php
                    echo "<div class='info-details'>";
                        echo "<h3 class='item-title'>" . $product['item_name'] . "</h3>";
                        echo "<p class='item-price'>" . $product['item_price'] . " €</p>";
                        echo "<p><strong>Descripción: </strong> " . $product['item_description'] . "</p>";
                        echo "<p><strong>Color: </strong> " . $product['item_colour'] . "</p>";
                    echo "</div>";
        
                    echo "<hr/>";


                    // SELECT SIZES
                    echo "<form action='add-cart.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $id . "'>";

                    echo "<div class='size-selector'>";
                    echo "<label><strong>Talla:</strong></label>";
                    echo "<select class='item-select' name='size' required>";
                    echo "<option value=''>Selecciona una talla</option>";

                    //GET SIZES FROM DATA BASE
                    $sizes_query = "SELECT * FROM Angelyn_sizes WHERE product_id = $id";
                    $sizes_result = mysqli_query($con, $sizes_query) 
                        or die("Error en query de tallas: " . mysqli_error($con));


                    while($size = mysqli_fetch_assoc($sizes_result)) {

                        $disabled = ($size['stock'] <= 0) ? "disabled" : "";

                        echo "<option value='" . $size['sizes'] . "' $disabled>";
                        echo $size['sizes'];

                        if($size['stock'] <= 0){
                            echo " (Agotado)";
                        }

                        echo "</option>";
                    }

                    echo "</select>";
                    echo "</div>";
                    echo "<br/>";
                    
                    // SELECT CUANTITIES
                    echo "<div class='product-quantity'>";

                    echo "<label><strong>Cantidad:</strong><label>";
                    echo "<button type='button' class='btn btn-subtract'>-</button>";
                    echo "<input type='text' class='quantity' name='tickets' value= '1'>";
                    echo "<button type='button' class='btn btn-add'><span>+</span></button>";
                    
                    echo "</div>";

                    echo "<br/>";

                    // SUBMIT BUTTON FORM
                    echo "<button type='submit' name='add-cart' class='btn-submit'>Añadir al carrito</button>";
                    echo "</form>";
                    ?>

                    <!-- PAYPAL BUTTON -->
                    <div id="paypal-button-container" class="paypal-button"></div>
                    <p id="result-message"></p>

                    <!-- Initialize the JS-SDK -->
                    <script
                        src="https://www.paypal.com/sdk/js?client-id=AUm83waF0yvNSI9BCYgcDAe9oAxi0pzV2uHOEK72FsAF9u88qB2ipZy3dC2My2sHn6lkX4IWWYuEHD47&buyer-country=US&currency=EUR&components=buttons&enable-funding=venmo,paylater,card"
                        data-sdk-integration-source="developer-studio"
                    ></script>

                    <script> const user_id = "<?php echo $_SESSION['username']; ?>"; </script>

                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

                    <script src="https://www.paypal.com/sdk/js?client-id=TU_ID&currency=EUR"></script>

                    <script src="appPaypal.js"></script>

                    <!--<div class="paypal-button">
                        <style>.pp-DTHWVUFK22JFA{text-align:center;border:none;border-radius:0.25rem;min-width:11.625rem;padding:0 2rem;height:2.625rem;font-weight:bold;background-color:#FFD140;color:#000000;font-family:"Helvetica Neue",Arial,sans-serif;font-size:1rem;line-height:1.25rem;cursor:pointer;}</style>
                        <form action="https://www.paypal.com/ncp/payment/DTHWVUFK22JFA" method="post" target="_blank" style="display:inline-grid;justify-items:center;align-content:start;gap:0.5rem;">
                            <input class="pp-DTHWVUFK22JFA" type="submit" value="Buy Now" />
                            <img src=https://www.paypalobjects.com/images/Debit_Credit_APM.svg alt="cards" />
                            <section style="font-size: 0.75rem;"> Powered by <img src="https://www.paypalobjects.com/paypal-ui/logos/svg/paypal-wordmark-color.svg" alt="paypal" style="height:0.875rem;vertical-align:middle;"/></section>
                        </form>
                    </div> -->
                    
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
    
    <script src="script.js"></script>

</body>
</html>