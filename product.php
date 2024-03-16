<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <?php include_once("./seller/top.php");?>
</head>

<body style="background-color:#e3eafc">
<?php 
    include_once("./seller/db.php");
    $store = $db->read("seller WHERE slug = '".$_GET["store"]."'");
    $product = $db->read_specific("product","slug = ?",[$_GET["product"]]);
    $category = $db->read_specific("category","id = ?",[$product[0]["CategoryId"]]);
    if($store ===0 || $product ==0){
        ?>
        <div class="d-flex min-vh-100 justify-content-center align-items-center">
            <div class="card ft-regular" style="width: 24rem;">
                <div class="card-body text-center">
                    <h4 class="card-title ft-bold">404 Page</h4>
                    <p class="card-text">No Product fount</p>
                </div>
            </div>
        </div>
    <?php }else{ ?>
    <!-- Navbar -->
    <?php include_once("header.php");?>

    <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto my-1 p-1 bg-light min-vh-100 tr-animate">
        
        <!-- Product Detail -->
        <div class="container mt-0 my-md-1">
            <div class="row">
            <div class="col-md-8 mx-auto d-flex justify-content-center">
                <img src="<?= $product[0]["Image"]?>" alt="Beats EP Red" class="img-fluid">
            </div>
            <div class="col-md-8 mx-auto d-flex flex-column justify-content-between py-4">
                <div>
                    <h2><?= $product[0]["name"]?></h2>
                    <p class="text-muted"><?= $category[0]["name"]?></p>
                    
                </div>       
                <div class="d-flex flex-column justify-content-between mt-4">
                <h3 class="text-danger">₹ <?= $product[0]["price"]?></h3>
                <button type="button" class="btn btn-primary">Buy Now</button>
                </div>
            </div>
            <div class="col-md-8 mx-auto my-4" style="min-height: 100px;">
                <p><?= htmlspecialchars_decode($product[0]["Description"])?></p>
            </div>

            </div>
        </div>
        <!-- Product Detail -->
        <hr>
        <div class="p-1">
            <h3 class="ft-medium"><?= $store[0]["businessName"] ?></h3>
            <p class="ft-regular"><?= $store[0]["businessAddress"] ?></p>
            <p> tel : <?= $store[0]["phone"] ?></p>
            <p> email : <?= $store[0]["email"] ?></p>
        </div>

    </div>
    <?php } ?>



    <?php include_once("bottom.php");?>
    <script>
    var splide = new Splide('.splide', {
        type: 'loop',
        autoplay: true,
        pagination: false,
        autoWidth: true,
        arrows: false,
        gap: 10
    });
    splide.mount();

    function filterFunction() {
        var input, filter, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("dropdownMenuButton");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    </script>
</body>

</html>