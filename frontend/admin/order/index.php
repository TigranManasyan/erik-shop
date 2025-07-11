<?php
    include("./ifAdmin.php");
    include("./../../../backend/db.php");
    $sql = "SELECT order_items.*, orders.status, orders.full_name, products.name FROM order_items
    INNER JOIN orders ON order_items.order_id = orders.id
    INNER JOIN products ON order_items.product_id = products.id";
    $res = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <?php include("./../../bootstrap.php"); ?>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-baseline">
                <h3>Orders</h3>
            </div>
            <div class="row">
                <?php include("./../../messages.php");?>
                <div class="col-md-12 d-flex flex-wrap-wrap">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Username</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Product Price</th>
                                <th>Total</th>
                                <th>Oreder Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $total_count = $total_price = $total = 0;
                            foreach ($orders as $order): ?>
                            <?php
                                $total_count += $order['qty'];
                                $total_price += $order['price'];
                                $total += $order['total'];
                                ?>
                                <tr>
                                    <td><?= $order['id']; ?></td>
                                    <td><?= $order['full_name']; ?></td>
                                    <td><?= $order['name']; ?></td>
                                    <td><?= $order['qty']; ?></td>
                                    <td><?= $order['price']; ?></td>
                                    <td><?= ($order['total']); ?></td>
                                    <td><?= ucfirst($order['status']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?= $total_count; ?></td>
                                <td><?= $total_price; ?></td>
                                <td><?= $total; ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $(".del").click(function(e) {
                e.preventDefault();

                if(!confirm("Delete?")) {
                    return;
                }
                let id = $(this).data('id');
                $.ajax({
                    url:'./../../../backend/admin/category/delete.php',
                    method:'get',
                    data:{id},
                    dataType:'json',
                    success:function(response) {
                        if(response.status == 200) {
                            alert(response.message);
                            location.reload();
                        }
                    }
                })
            });
        })
    </script>
</body>
</html>