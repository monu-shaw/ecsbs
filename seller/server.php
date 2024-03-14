<?php
 ini_set('display_errors', 1);
 error_reporting(-1);


  include("db.php");
  session_start();

if(isset($_POST["addproduct"])){
    // Sanitize and validate input
    $name = test_input($_POST['name']);
    $sellerId = test_input($_POST['sellerId']);
    $categoryId = test_input($_POST['categoryId']);
    $description = test_input($_POST['description']);
    $measuringUnit = test_input($_POST['measuringUnit']);
    $measuringSize = test_input($_POST['measuringSize']);

    // Generate slug from name
    $slug = slugGen($name);
    $res = $db->read_specific("product", "slug = ? , categoryId = ?",[$slug, $categoryId]);

    // Check if name is not empty
    if (empty($name)) {
        echo res(400,["Name is required."]);
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
    echo res(200,$res);
    return;
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
    global $db;
    if ($db->read_specific("seller", "email = ?",[$data["email"]])) {
      $errors[] = "Email Already Exist";
    }
    if ($db->read_specific("seller", "phone = ?",[$data["phone"]])) {
      $errors[] = "Phone Already Exist";
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
      'slug'=> slugGen($data["businessName"]),
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
  $data = [
      'email' => $email,
      'phone' => $phone,
      'sellerName' => $sellerName,
      'businessName' => $businessName,
      'businessAddress' => $businessAddress,
      'country' => $country,
      'currency' => $currency,
      'password' => $password,
      'confirmPassword' => $confirmPassword
  ];

  // Encode the data array to JSON format
  try {
    $a = $db->read_specific("seller", "email = ?",[$data["email"]]);
    $validationResult = handleSignupData($data);

    if (!(array_keys($validationResult) !== range(0, count($validationResult) - 1))) {
      echo res(400,$validationResult);
    } else {  
      $res = $db->create("seller",$validationResult);
      echo res(200,$res);
    }
  }catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
  }
  

  // Output the JSON data
  //echo $jsonData;
  

}

if(isset($_POST["login"])){
  function handleSignupData($data) {
    $errors = [];
  
    // Validate email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email address";
    }
    global $db;
    $user = $db->read_specific("seller", "email = ?",[$data["email"]]);
    if($user) {
      if(!password_verify($data["password"],$user[0]["password"])){
        $errors[] = "Password Inncorect";
      }

    }
  
    if ($errors) {
      return $errors;  // Indicate errors
    }
    return $user[0];
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
  $data = [
      'email' => $email,
      'phone' => $phone,
      'sellerName' => $sellerName,
      'businessName' => $businessName,
      'businessAddress' => $businessAddress,
      'country' => $country,
      'currency' => $currency,
      'password' => $password,
      'confirmPassword' => $confirmPassword
  ];

  // Encode the data array to JSON format
  try {
    $a = $db->read_specific("seller", "email = ?",[$data["email"]]);
    $validationResult = handleSignupData($data);

    if (!(array_keys($validationResult) !== range(0, count($validationResult) - 1))) {
      echo res(400,$validationResult);
    } else {  
      $res = $validationResult;
      unset($res["password"]);
      unset($res["createdAt"]);
      $_SESSION["login"] = $res;
      echo res(200,$validationResult);
    }
  }catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
  }
  

  // Output the JSON data
  //echo $jsonData;
  

}

if(isset($_POST["addcategory"])){
  $name = test_input($_POST['name']);
  $sellerId = test_input($_POST['sellerId']);
  $image = test_input($_POST['image']);
  $slug = slugGen($name);

  $res = $db->read_specific("category", "slug = ? AND sellerId = ?",[$slug, $sellerId]);

  if($res==0){
    try {
      $r = $db->create("category",["name"=>$name,"sellerId"=>$sellerId,"image"=>$image,"slug"=>$slug]);
      echo res(200,$r);
    } catch (Exception $th) {
      echo res(400, [$th->getMessage()]);
    }
  }else{
    echo res(400,["Category Exist"]);
  }
}