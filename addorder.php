<?php
// Assuming $db is your database connection object
// and $_POST contains the order details
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit;
}

session_start();
include_once("./seller/db.php");

$orderId = random_strings(5);
// Prepare the order details array
$store = $_POST['slug'];
$orderDetails = array(
    'amount' => $_POST['amount'],
    'customerName' => test_input($_POST['customerName']),
    'customerPhone' => test_input($_POST['customerPhone']),
    'customerAddress' => test_input($_POST['customerAddress']),
    'customerPincode' => test_input($_POST['customerPincode']),
    'sellerId' => test_input($_POST['sellerId']),
    'status' => "pending",
    'orderId' => $orderId
);

// Insert the order into the database
$insertOrder = $db->create('ordertable', $orderDetails);
echo var_dump($insertOrder);
if ($insertOrder) {
    // If the order is successfully added, add each item in the cart to the order items table
    if (isset($_SESSION[$store.'cart']) && !empty($_SESSION[$store.'cart'])) {
        foreach ($_SESSION[$store.'cart'] as $product) {
            $insertOrderItem = $db->create('orderItem', array(
                'orderId' => $orderId,
                "productId" => $product["id"],
                "quantity" => $product["quantity"]
            ));
        }
    }
    session_destroy();
    // Redirect to track.php
    header('Location: '.$base.'track/'.$store.'/'.$orderId);
    exit;
} else {
    // Handle error
    echo "Failed to add order.";
}
