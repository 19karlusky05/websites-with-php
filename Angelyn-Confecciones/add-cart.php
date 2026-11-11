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
             <?php
            if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>
            <div class="cart-icon">
                <a href="cart.php" class="cart-link">
                    <i class="fa-solid fa-cart-shopping cart-icon"></i>
                    <span class="cart-count"><?php echo $cart_count; ?></span>
                </a>
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
        <div class="cart-container">
            <paypal-cart-button data-id="pp-view-cart"></paypal-cart-button>
            <script>
            cartPaypal.Cart({ id: "pp-view-cart" })
            </script>
        </div>
                
        <div class="item-info">
            <paypal-add-to-cart-button data-id="5W8E74TN2477J"></paypal-add-to-cart-button>
            <script>
            cartPaypal.AddToCart({ id: "5W8E74TN2477J" })
            </script>
        </div>

        <div id="paypal-button-container"></div>
        <p id="result-message"></p>

    
        <script src="appPaypal.js"></script>

    </section>