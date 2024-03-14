<?php
    include_once("db.php");
?>
<?php
if(isset($_POST["addproduct"])){
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate input
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $sellerId = filter_input(INPUT_POST, 'sellerId', FILTER_SANITIZE_NUMBER_INT);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
    $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $measuringUnit = trim(filter_input(INPUT_POST, 'measuringUnit', FILTER_SANITIZE_STRING));
    $measuringSize = filter_input(INPUT_POST, 'measuringSize', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Generate slug from name
    $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));

    // Check if name is not empty
    if (empty($name)) {
        echo "Name is required.";
        exit;
    }
    // Prepare associative array for database insertion
    $data = [
        'name' => $name,
        'sellerId' => $sellerId,
        'categoryId' => $categoryId,
        'description' => $description,
        'measuringUnit' => $measuringUnit,
        'measuringSize' => $measuringSize,
        'slug' => $slug
    ];
    // Assuming you have a table named 'products' with columns matching the keys of $data
    echo res(200,$data);
    return;
} else {
    echo "No data received.";
}
}


if(isset($_POST["signup"])){

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
    echo res(400,$validationResult);
  } else {  
    echo "Data validated and ready for insertion";
  }

}

if(isset($_POST["addcategory"])){
  echo res(200,$_POST)
}