<?php

include_once("./seller/db.php");
session_start();
$id = $_GET['product']; // Get the product ID from the URL
$storeId = $_GET['store']; // Get the store ID from the URL

// Check if the product exists in the database
$product = $db->read_single("product", $id);
if (!$product) {
    // If product not found, output a message
    echo "Product not found.";
    exit;
}
// Initialize the cart session variable if not already set
if (!isset($_SESSION[$storeId.'cart'])) {
    $_SESSION[$storeId.'cart'] = array();
}

// Check if the product is already in the cart
if (array_key_exists($id, $_SESSION[$storeId.'cart'])) {
    // If product exists, increase the quantity
    $_SESSION[$storeId.'cart'][$id]['quantity'] += 1;
} else {
    // If product not in cart, add it
    $_SESSION[$storeId.'cart'][$id] = $product;
    if(!isset($_SESSION[$storeId.'cart'][$id]['quantity'])){
        $_SESSION[$storeId.'cart'][$id]['quantity'] = 1;
    }
}

// Redirect to cart.php
header('Location: '.$base.'cart/'.$storeId);
exit;

?>