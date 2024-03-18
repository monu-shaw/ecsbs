<?php

include_once("./seller/db.php");
session_start();
$id = $_GET['product']; // Get the product ID from the URL
$storeId = $_GET['store']; // Get the store ID from the URL

if (array_key_exists($id, $_SESSION[$storeId.'cart'])) {
    unset($_SESSION[$storeId.'cart'][$id]);
} else {
    
}

// Redirect to cart.php
header('Location: '.$base.'cart/'.$storeId);
exit;

?>