<?php
session_start();
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $_SESSION['msg'] = [
        'type' => 'auth_fail',
        'text' => 'Խնդրում ենք մուտք գործել'
    ];
    header("location:./../index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <?php include "./../../bootstrap.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

</head>
<body>
    <?php include "./../navbar.php"; ?>
    <div class="container">

        <div class="container d-flex justify-content-center mt-50 mb-50">

            <div class="row" id="products">

            </div>
        </div>
    </div>

    <script>


        let url = 'http://localhost/time_to_code_lessons/Erik/shop/backend/user/product/';
        let uploads_path = 'http://localhost/time_to_code_lessons/Erik/shop/backend/admin/uploads/';
        jQuery(document).ready(function($) {
            function drawProducts(data) {
                console.log(data);
                let html = '';
                data.forEach(function(product) {
                    html += `
                        <div class="col-md-8 mt-2">
                    <div class="card product-item">
                        <div class="card-body">
                            <div class="card-img-actions">
                                <img src="${uploads_path}/${product.image}" class="card-img img-fluid" width="200px" height="350" alt="">
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-2">
                                    <a href="#" class="text-muted" data-abc="true">${product.name} (${product.category_name})</a>

                                </h6>
                            </div>

                            <h3 class="mb-0 font-weight-semibold">${product.price}</h3>
                            <button data-id='${product.id}' type="button" class="btn add_cart btn-danger mt-3"><i class="fa fa-cart-plus mr-2"></i> Ավելացնել </button>
                        </div>
                    </div>
                </div>
                    `;

                });
                $("#products").html(html);
                $(".product-item .add_cart").on("click", function() {
                    let product_id = parseInt($(this).data('id'));
                    $.ajax({
                        url:`${url}add_to_cart.php`,
                        method: 'post',
                        data:{product_id},
                        dataType: 'json',
                        success:function(response) {
                            if(response.status == 200) {
                                alert(response.msg);
                            }
                        }
                    });
                })
            }
            $.ajax({
                url:`${url}select.php`,
                method:'get',
                dataType:'json',
                success: async function(response) {
                    if(response.data.length > 0) {
                        drawProducts(response.data);
                    }
                },
                error:function (e) {
                    console.log(e);
                }
            });
        });
    </script>
</body>
</html>
