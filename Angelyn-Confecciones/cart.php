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
    <script src="https://www.paypalobjects.com/ncp/cart/cart.js" data-merchant-id="LXW7Z7QN2DVT6"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=BAABjvUIdCAD4LNhaLzkhNItssKkij5akW_4TUUJeh4JwbaLlFIpqS-ZGS6p-aI0UHC5PvmhAgO3YX5tps&components=hosted-buttons&disable-funding=venmo&currency=EUR"></script>
</head>

<body id="top">
    <?php if ($_SESSION['username']) {
        echo"<h2>Welcome, " . $_SESSION['username'] . "!</h2>";
        echo"<a href='logout.php' class='logout-btn'>Logout</a>";
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

            <!-- Cart button with DB -->
             <?php
            if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>
            <div class="cart-icon">
            <a href="cart.php" class="cart-link">
                <i class="fa-solid fa-cart-shopping cart-icon"></i>
                <span class="cart-count"><?php echo $cart_count; ?></span></a>
            </div>
            <?php
            }
            ?>

            <div class="burger-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <section class="wrapper cart-wrapper">
        <?php

        $status = "";

        /* =========================
        ELIMINAR PRODUCTO
        ========================= */
        if (isset($_POST['action']) && $_POST['action'] == "remove") {

            if (!empty($_SESSION["shopping_cart"])) {

                foreach ($_SESSION["shopping_cart"] as $key => $value) {

                    if ($_POST["key"] == $key) {

                        unset($_SESSION["shopping_cart"][$key]);

                        $status = "Producto eliminado del carrito";
                    }
                }

                if (empty($_SESSION["shopping_cart"])) {
                    unset($_SESSION["shopping_cart"]);
                }
            }
        }

        /* =========================
        CAMBIAR CANTIDAD
        ========================= */
        if (isset($_POST['action']) && $_POST['action'] == "change") {

            foreach ($_SESSION["shopping_cart"] as &$value) {

                if ($_POST["key"] == $value["key"]) {

                    $value["quantity"] = $_POST["quantity"];
                }
            }
        }
        ?>

        <div class="cart">

        <?php

        /* =========================
        MOSTRAR CARRITO
        ========================= */
        if (isset($_SESSION["shopping_cart"])) {

            $total_price = 0;

            echo "<table class='table'>";
            echo "<tbody>";

            echo "<tr>";
            echo "<td>Imagen</td>";
            echo "<td>Producto</td>";
            echo "<td>Talla</td>";
            echo "<td>Cantidad</td>";
            echo "<td>Precio</td>";
            echo "<td>Total</td>";
            echo "<td>Acción</td>";
            echo "</tr>";

            foreach ($_SESSION["shopping_cart"] as $key => $product) {

                echo "<tr>";

                // =========================
                // IMAGEN
                // =========================
                echo "<td>";
                echo "<img src='images/content/bebes/" . $product['image'] . "' width='60'>";
                echo "</td>";

                // =========================
                // NOMBRE
                // =========================
                echo "<td>";
                echo $product['name'];
                echo "</td>";

                // =========================
                // TALLA
                // =========================
                echo "<td>";
                echo $product['size'];
                echo "</td>";

                // =========================
                // CANTIDAD
                // =========================
                echo "<td>";

                echo "<form method='post'>";
                echo "<input type='hidden' name='key' value='" . $key . "'>";
                echo "<input type='hidden' name='action' value='change'>";

                echo "<select name='quantity' onchange='this.form.submit()'>";

                for ($i = 1; $i <= 10; $i++) {

                    $selected = ($product['quantity'] == $i) ? "selected" : "";

                    echo "<option value='" . $i . "' $selected>" . $i . "</option>";
                }

                echo "</select>";
                echo "</form>";

                echo "</td>";

                // =========================
                // PRECIO UNITARIO
                // =========================
                echo "<td>";
                echo number_format($product['price'], 2) . " €";
                echo "</td>";

                // =========================
                // TOTAL ITEM
                // =========================
                $subtotal = $product['price'] * $product['quantity'];

                echo "<td>";
                echo number_format($subtotal, 2) . " €";
                echo "</td>";

                $total_price += $subtotal;

                // =========================
                // ELIMINAR
                // =========================
                echo "<td>";

                echo "<form method='post'>";
                echo "<input type='hidden' name='key' value='" . $key . "'>";
                echo "<input type='hidden' name='action' value='remove'>";
                echo "<button type='submit'>Eliminar</button>";
                echo "</form>";

                echo "</td>";

                echo "</tr>";
            }

            // =========================
            // TOTAL GENERAL
            // =========================
            echo "<tr>";
            echo "<td colspan='6' style='text-align:right;'><strong>TOTAL:</strong></td>";
            echo "<td><strong>" . number_format($total_price, 2) . " €</strong></td>";
            echo "</tr>";

            echo "</tbody>";
            echo "</table>";

        } else {

            echo "<h3>Tu carrito está vacío</h3>";
        }
        ?>

        </div>

        <!-- MENSAJE -->
        <div class="message_box">
            <?php echo $status; ?>
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