<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include("connection.php");

echo "<pre>";

// =========================
// VALIDAR CONEXIÓN
// =========================
if (!$con) {
    die("Error de conexión a la base de datos");
}

// =========================
// RECIBIR DATOS
// =========================
$product_id = intval($_POST['product_id'] ?? 0);
$size = $_POST['size'] ?? '';
$quantity = intval($_POST['tickets'] ?? 0);

echo "PRODUCT ID: " . $product_id . "<br>";
echo "SIZE: " . $size . "<br>";
echo "QUANTITY: " . $quantity . "<br>";

// =========================
// VALIDACIÓN BÁSICA
// =========================
if ($product_id <= 0 || $size == '' || $quantity <= 0) {
    die("Datos inválidos");
}

// =========================
// CONSULTA PRODUCTO
// =========================
$query = "SELECT * FROM Angelyn_products WHERE item_id = $product_id";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}

if (mysqli_num_rows($result) == 0) {
    die("Producto no encontrado");
}

$product = mysqli_fetch_assoc($result);

// =========================
// DATOS DEL PRODUCTO
// =========================
$name = $product['item_name'];
$price = $product['item_price'];
$image = $product['item_img'];

echo "PRODUCT NAME: " . $name . "<br>";
echo "PRICE: " . $price . "<br>";

// =========================
// CLAVE ÚNICA DEL CARRITO
// =========================
$key = $product_id . "_" . $size;

// =========================
// INICIALIZAR CARRITO
// =========================
if (!isset($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = array();
    echo "Carrito creado<br>";
}

// =========================
// AÑADIR O ACTUALIZAR
// =========================
if (isset($_SESSION["shopping_cart"][$key])) {

    $_SESSION["shopping_cart"][$key]["quantity"] += $quantity;

    echo "Cantidad actualizada en carrito<br>";

} else {

    $_SESSION["shopping_cart"][$key] = array(
        "key" => $key,
        "product_id" => $product_id,
        "name" => $name,
        "price" => $price,
        "size" => $size,
        "quantity" => $quantity,
        "image" => $image
    );

    echo "Producto añadido al carrito<br>";
}

// =========================
// MOSTRAR CARRITO (DEBUG)
// =========================
echo "<hr>";
echo "CARRITO ACTUAL:<br>";

echo "<pre>";
print_r($_SESSION["shopping_cart"]);
echo "</pre>";

// =========================
// REDIRECCIÓN FINAL
// =========================
echo "Redirigiendo a cart.php...";
header("Location: cart.php");
exit;

?>