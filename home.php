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
    $category = $db->read_specific("category","sellerId = ?",[$store[0]["id"]]);
    $products = $db->read_specific("product","SellerId = ?",[$store[0]["id"]]);
    if($store ===0){
        ?>
        <div class="d-flex min-vh-100 justify-content-center align-items-center">
            <div class="card ft-regular" style="width: 24rem;">
                <div class="card-body text-center">
                    <h4 class="card-title ft-bold">No Store</h4>
                    <p class="card-text">Creat your E-Commerce store Here</p>
                    <a href="<?=$base?>seller/index.php" class="btn btn-success">Create</a>
                </div>
            </div>
        </div>
    <?php }else{ ?>
    <!-- Navbar -->
    <?php include_once("header.php");?>

    <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto my-1 p-1 bg-light min-vh-100 tr-animate">
        <div class="jumbotron text-center border border-end-0 border-start-0 my-1">
            <h1 class="display-4">- Our Category - </h1>
        </div>
        <div class="<?= ($category ==0)?"":"d-none" ?> my-5 text-center">
            <h3 class="ft-medium"> No Category Exist</h3>
        </div>
        <section class="splide <?= ($category ==0)?"d-none":"" ?>" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                        // Loop through the associative array
                        foreach ($category as $item) {
                            // Print each card wrapped in a splide__slide
                            echo '<div class="splide__slide">';
                            echo '<div class="card" style="width: 14rem;">';
                            echo '<img src="'.$item["Image"].'" class="card-img-top img-fit" alt="' . $item['name'] . '">';
                            echo '<div class="card-body">';
                            echo '<h6 class="card-title">' . $item['name'] . '</h6>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                </ul>
            </div>
        </section>
        <div class="jumbotron text-center border border-end-0 border-start-0 my-1">
            <h1 class="display-4">- Our Products - </h1>
        </div>
        <div class="<?= ($products==0)?"":"d-none" ?> my-5 text-center">
            <h3 class="ft-medium"> No Product Exist</h3>
        </div>
        <div class="container <?= ($products==0)?"d-none":"" ?>">
            <div class="row">
                <?php foreach ($products as $product): ?>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <img src="<?=$product["Image"]?>" class="img-fit" alt="<?php echo $product['name']; ?>">
                                </div>
                                <div class="col-6">
                                    <a class="text-decoration-none text-capitalize" href="<?=$base?>product/<?= $product["slug"]."/".$_GET["store"]?>"><h5 class="card-title text-truncate"><?php echo $product['name']; ?></h5></a>
                                    <p class="card-text text-truncate"><?php echo $product['Description']; ?></p>
                                    <p class="card-text"><small
                                            class="text-muted">₹ <?php echo $product['price']; ?></small></p>
                                    <a href="<?=$base?>addtocart/<?= $product["id"]?>/<?=$store[0]["slug"]?>"><button type="button" class="btn btn-primary">Add to Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
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