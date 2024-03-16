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
                <a href="seller/index.php" class="btn btn-success">Create</a>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <!-- Navbar -->
    <?php include_once("header.php");?>

    <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto my-1 p-1 bg-light min-vh-100 tr-animate">
        <!-- <Checkout UI -->
        <div class="container mt-5">
            <div class="">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Order ID</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
            </div>
            <div class="d-flex flex-wrap">
                <div class="col-12 col-md-8 p-1 pe-3 ">
                    <div class="">
                        <h2> Item</h2>
                        <div class=" mb-3">
                            <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td colspan="2">Name</td>
                                        <td>1</td>
                                        <td>₹1</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Name</td>
                                        <td>1</td>
                                        <td>₹1</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Name</td>
                                        <td>1</td>
                                        <td>₹1</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-1">
                    <div class="">
                        <h2>Order Summary</h2>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Cart</td>
                                    <td>₹149</td>
                                </tr>
                                <tr>
                                    <td>Delivery</td>
                                    <td>₹19</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>₹168</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-1 ">
                    <div class="">
                        <h2>Customer Detail</h2>
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="123 Main St" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zip" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" type="number" id="zip" maxlength="5" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <Checkout UI -->
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