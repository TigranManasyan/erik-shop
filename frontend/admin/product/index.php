<?php
    include("./ifAdmin.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
    <?php include("./../../bootstrap.php"); ?>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-baseline">
                <h3>Products</h3>
                <a class="btn btn-primary btn-sm" href="./create.php">Create New Product</a>
            </div>
            <div class="row">
                <?php include("./../../messages.php");?>
                <table id="products-data" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="products"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            function drawProducts(data) {
                $("#products").html("");
                data.forEach(function(product) {
                    $("#products").append(`
                        <tr>
                            <td><img style="width:60px" src="./../../../backend/admin/uploads/${product.image}" alt=""></td>
                            <td>${product.product_name}</td>
                            <td>${product.category_name}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">More</a>
                            </td>
                        </tr>
                    `)
                })

            }
                $.ajax({
                    url:'./../../../backend/admin/product/select.php',
                    method:'get',
                    dataType:'json',
                    success:function(response) {
                        drawProducts(response.data)
                    }
                });
        })
    </script>
</body>
</html>