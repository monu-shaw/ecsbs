<?php
    include_once("db.php");
?>
<?php

function handleSignupData($data) {
  $errors = [];

  // Validate email
  if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address";
  }

  // Validate phone number (basic check)
  if (!preg_match('/^[0-9]+$/', $data['phone'])) {
    $errors[] = "Invalid phone number (numbers only)";
  }

  // Validate other fields (add more checks as needed)
  if (empty($data['sellerName'])) {
    $errors[] = "Seller name is required";
  }
  if (empty($data['businessName'])) {
    $errors[] = "Business name is required";
  }
  if (empty($data['businessAddress'])) {
    $errors[] = "Business address is required";
  }
  if (empty($data['password']) || $data['password'] !== $data['confirmPassword']) {
    $errors[] = "Passwords do not match";
  }

  // Validate password strength (optional)
  // You can use a password library for more complex checks

  if ($errors) {
    return $errors;  // Indicate errors
  }

  // Prepare data for database insertion (associative array for columns)
  return [
    'email' => $data['email'],
    'phone' => $data['phone'],
    'sellerName' => $data['sellerName'],
    'businessName' => $data['businessName'],
    'businessAddress' => $data['businessAddress'],
    'country' => $data['country'],
    'currency' => $data['currency'],
    'password' => password_hash($data['password'], PASSWORD_DEFAULT), // Hash password before storing
  ];
}

// Example usage (assuming data is received from the form)
$signupData = [
  'email' => 'user@example.com',
  'phone' => '1234567890',
  'seller_name' => 'John Doe',
  'business_name' => 'My Business',
  'business_address' => '123 Main St',
  'country' => 'US',
  'currency' => 'INR',
  'password' => 'secretpassword',
  'confirm_password' => 'secretpassword',
];



// Output the JSON data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$sellerName = isset($_POST['sellerName']) ? $_POST['sellerName'] : '';
$businessName = isset($_POST['businessName']) ? $_POST['businessName'] : '';
$businessAddress = isset($_POST['businessAddress']) ? $_POST['businessAddress'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$currency = isset($_POST['currency']) ? $_POST['currency'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';

// Prepare the data array
$data = array(
    'email' => $email,
    'phone' => $phone,
    'sellerName' => $sellerName,
    'businessName' => $businessName,
    'businessAddress' => $businessAddress,
    'country' => $country,
    'currency' => $currency,
    'password' => $password,
    'confirmPassword' => $confirmPassword
);

// Encode the data array to JSON format
$validationResult = handleSignupData($data);
$jsonData = json_encode($data);

// Output the JSON data
//echo $jsonData;
if (is_array($validationResult)) {
  // $validationResult contains errors
  print_r($validationResult);  // Display errors for debugging
} else {
  // $validationResult contains valid data for database insertion
  // You can now insert the data into your database using the associative array
  echo "Data validated and ready for insertion";
}
