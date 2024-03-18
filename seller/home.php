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
        include_once("db.php");
        $table = $db->read_specific("product","sellerId = ?",[$_SESSION["login"]["id"]]);
        $orders = $db->read_specific("ordertable","sellerId = ?",[$_SESSION["login"]["id"]]);
        
    ?>
    <div class="col-12 col-md-10 col-lg-8 mx-auto card">
        <div class="card-header">
            <h2>Orders</h2>
        </div>
        <div class="card-body">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row -->
                    <?php foreach ($orders as $order) {
                        echo '
                        <tr>
                        <td>'.$order["date"].'</td>
                        <td>₹'.$order["amount"].'</td>
                        <td>'.$order["status"].'</td>
                        <td>'.$order["customerName"].'</td>
                        <td>
                            <a href="order.php?order='.$order["orderId"].'" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                        </tr>
                        ';
                    }?>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
    <?php 
        echo "<pre>";
        echo $_SESSION["login"]["id"];
    ?>
    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
</body>
</html>