<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Home - ECSBS</title>
    <?php include_once("top.php");?>
</head>
<body>
    <?php include_once("header.php");?>
    
    <?php 
        echo "<pre>";
        echo $_SESSION["login"]["id"];
    ?>

    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
</body>
</html>