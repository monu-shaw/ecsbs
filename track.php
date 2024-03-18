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
    $order = $db->read_specific("ordertable","orderId = ?",[$_GET["order"]]);
    $items = $db->read_specific("orderItem","orderId = ?",[$_GET["order"]]);
    $products = [];
    $total = 0;
    foreach ($items as  $item) {
        $t = $db->read_single("product",$item["productId"]);
        $t["quantity"] = $item["quantity"];
        array_push($products,$t);
    }
    if($store ===0 || !$items){
        ?>
    <div class="d-flex min-vh-100 justify-content-center align-items-center">
        <div class="card ft-regular" style="width: 24rem;">
            <div class="card-body text-center">
                <h4 class="card-title ft-bold">404 Page</h4>
                <p class="card-text">No order Found</p>
                <div id="viewOrder" class="row">
                    <div class="mb-3 col-md-10">
                    <input type="text" class="form-control" id="orderId" placeholder="order Id">
                    </div>
                    <div class="mb-3 col-md-2">
                        <button onclick="search()" class="btn btn-primary"> <i class="bi bi-search"></i></button>
                    </div>
                </div>
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
                <div id="viewOrder" class="row col-md-10 col-lg-8">
                    <div class="mb-3 col-10">
                        <input type="text" class="form-control" id="orderId" value="<?= $order[0]["orderId"] ?>">
                    </div>
                    <div class="mb-3 col-2">
                        <button onclick="search()" class="btn btn-primary"> <i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-wrap">
                <div class="col-12 col-md-8 p-1 pe-3 ">
                    <div class="">
                        <h2> Item</h2>
                        <div class=" mb-3">
                            <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                <?php foreach ($products as $product){
                                        $total += $product["price"]*$product["quantity"];
                                        ?>
                                    <tr>
                                        <td colspan="2"><?= $product["name"]?></td>
                                        <td><?= $product["quantity"]?></td>
                                        <td>₹ <?=$product["quantity"]*$product["price"]?></td>
                                    </tr>
                                <?php }?>
                                    <tr class="border border-2 secondary">
                                        <td colspan="3">Order Status</td>
                                        <td><?= $order[0]["status"]?></td>
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
                                    <td>Total</td>
                                    <td>₹ <?= $total ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-1 ">
                    <div class="">
                        <h2>Customer Detail</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="" disabled value="<?= $order[0]["customerName"]?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="" disabled value="<?= $order[0]["customerPhone"]?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="123 Main St" disabled value="<?= $order[0]["customerAddress"]?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zip" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" type="number" id="zip" maxlength="5" disabled value="<?= $order[0]["customerPincode"]?>">
                            </div>
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
    function search(){
        let orderid = $('#orderId').val();
        location.href = `<?= $base.'track/'.$store[0]["slug"].'/' ?>`+orderid;
    }
    $(document).ready(function() {
    })
    </script>
</body>

</html>