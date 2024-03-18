<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);


  include_once("db.php");
  session_start();

if(isset($_POST["addproduct"])){
    // Sanitize and validate input
    $name = test_input($_POST['name']);
    $sellerId = test_input($_POST['sellerId']);
    $categoryId = test_input($_POST['categoryId']);
    $description = test_input($_POST['description']);
    $measuringUnit = test_input($_POST['measuringUnit']);
    $measuringSize = test_input($_POST['measuringSize']);
    $image = test_input($_POST['image']);
    $price = test_input($_POST['price']);
    $mrp = test_input($_POST['mrp']);

    // Generate slug from name
    $slug = slugGen($name);
    $res = $db->read_specific("product", "slug = ? AND categoryId = ?",[$slug, $categoryId]);

    // Check if name is not empty
    if (empty($name)) {
        echo res(400,["Name is required."]);
        exit;
    }

    
    $data = [
        'name' => $name,
        'sellerId' => $sellerId,
        'categoryId' => $categoryId,
        'description' => $description,
        'measuringUnit' => $measuringUnit,
        'measuringSize' => $measuringSize,
        'slug' => $slug,
        'image'=> $image,
        'price'=> $price,
        'mrp'=> $mrp
    ];
    $r = $db->create("product",$data);
    echo res(200,$r);
    return;
}
elseif(isset($_POST["editproduct"])){
    // Sanitize and validate input
    $name = test_input($_POST['name']);
    $sellerId = test_input($_POST['sellerId']);
    $categoryId = test_input($_POST['categoryId']);
    $description = test_input($_POST['description']);
    $measuringUnit = test_input($_POST['measuringUnit']);
    $measuringSize = test_input($_POST['measuringSize']);
    $id = test_input($_POST['id']);
    $price = test_input($_POST['price']);
    $mrp = test_input($_POST['mrp']);
    
    $res = $db->read_specific("product", "id = ?",[$id]);

  if($res!=0){
    try {
      $r = $db->update("product","name = '" . $name . "', SellerId = '" . $sellerId . "', CategoryId = '" . $categoryId . "', Description = '" . $description . "', MeasuringUnit = '" . $measuringUnit . "', MeasuringSize = '" . $measuringSize . "'" , "id = '".$id."'");
      if($r==1){
        echo res(200,$r);
      }else{
        echo res(400,["Error Occured"]);
      }
    } catch (PDOException $th) {
      echo res(400, [$th->getMessage()]);
    }
  }else{
    echo res(400,["Category Exist"]);
  }
}


elseif(isset($_POST["signup"])){
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
    
  
    if ($errors) {
      return $errors;  // Indicate errors
    }
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
  
  

}

elseif(isset($_POST["login"])){
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
    if($user ===0){
      $errors[] = "User not exist";
    }
  
    if ($errors) {
      return $errors;  // Indicate errors
    }
    
    return $user[0];
  }


  // Output the JSON data
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  // Prepare the data array
  $data = [
      'email' => $email,
      'password' => $password,
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
  

}

elseif (isset($_POST["addcategory"])){
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

elseif(isset($_POST["editcategory"])){
  $name = test_input($_POST['name']);
  $sellerId = test_input($_POST['sellerId']);
  $categoryId = test_input($_POST['categoryId']);

  $res = $db->read_specific("category", "id = ? AND sellerId = ?",[$categoryId, $sellerId]);

  if($res!=0){
    try {
      $r = $db->update("category","name = '".$name."'","id = '".$categoryId."'");
      if($r==1){
        echo res(200,$r);
      }else{
        echo res(400,["Error Occured"]);
      }
    } catch (PDOException $th) {
      echo res(400, [$th->getMessage()]);
    }
  }else{
    echo res(400,["Category Exist"]);
  }
}

elseif(isset($_POST["del"])){
  
    $id = test_input($_POST['id']);
    $type = test_input($_POST['type']);
    
    if($type=="category"){
      $eixst = $db->read_specific("category", "id = ? ",[$id]);
      if($eixst != 0){
          $res = $db->delete("category",[$id]);
            echo res(200, $res);
      }else{
        echo res(400,["item not exist"]);
      }
    }else{
      $eixst = $db->read_specific("product", "id = ? ",[$id]);
      if($eixst != 0){
          $res = $db->delete("product",[$id]);
            echo res(200, $res);
      }else{
        echo res(400,["item not exist"]);
      }
    } 

}

else{
  echo res(404,["not found"]);
}

?>