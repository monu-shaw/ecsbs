<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - ECSBS</title>
    <?php include_once("top.php");?>
</head>

<body>
    <?php include_once("header.php");?>
    <?php
        include_once("db.php");
        $table = $db->read_specific("product","sellerId = ?",[$_SESSION["login"]["id"]]);
        $orders = $db->read_specific("ordertable","orderId = ?",[$_GET["order"]]);
        $items = $db->read_specific("orderItem","orderId = ?",[$_GET["order"]]);
        $products = [];
        $total = 0;
        foreach ($items as  $item) {
            $t = $db->read_single("product",$item["productId"]);
            $t["quantity"] = $item["quantity"];
            array_push($products,$t);
        }
        
    ?>
    <div class="col-12 col-md-10 col-lg-8 mx-auto border">
        <div class="container mt-5">
            <div class="d-flex flex-wrap">
                <div class="col-12 col-md-10 p-2 d-flex">
                <form action="server.php" method="post">
                    <div class="form-group">
                        <input type="text" hidden class="form-control" id="orderId" name="orderId" value="<?php echo $_GET['id']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" value="<?= $orders[0]["status"]?>">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="shipped">Shipped</option>
                            <option value="out_for_delivery">Out for Delivery</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form> 
                </div>
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
                                    <td>₹<?=$total?></td>
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
    </div>
    
    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
</body>

</html>