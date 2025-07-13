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
    <title>My cart</title>
    <?php include "./../../bootstrap.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../dist/css/cart.css">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

</head>
<body>
<?php include "./../navbar.php"; ?>
<div class="container">

    <div class="container d-flex justify-content-center mt-50 mb-50">

        <div class="row" id="cart_items">

        </div>



    </div>
    <div>
        <form id="myForm">
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input id="full_name" class="form-control" type="text" name="full_name" placeholder="John Smith">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="+37494121212">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" class="form-control" type="text" name="address" placeholder="City, state">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea rows="4" id="comment" name="comment" class="form-control" placeholder="Comment..."></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mt-2">Accept</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>


    let url = 'http://localhost/time_to_code_lessons/Erik/shop/backend/user/product/';
    let uploads_path = 'http://localhost/time_to_code_lessons/Erik/shop/backend/admin/uploads/';
    jQuery(document).ready(function($) {
        function drawCart(data) {
            let html = '';
            data.forEach(function(item) {
                html += `
                        <div class='cart-item' data-product_price='${item.price}' data-product_id='${item.product_id}'>
                            <div class='product-image'>
                                <img src="${uploads_path}${item.image}" alt="">
                            </div>
                            <div class='product-info'>
                                <h4>${item.name}</h4>
                            </div>
                            <div class='product-qty'>
                                <button data-qty='${item.qty}' data-action='minus' data-id='${item.id}' class='change-count'>-</button>
                                    <strong>${item.qty}</strong>
                                <button data-action='plus' data-qty='${item.qty}' data-id='${item.id}' class='change-count'>+</button>

                            </div>
                            <div class='product-price'>
                                ${Math.round(item.price * item.qty)}AMD
                            </div>
                            <div class='product-delete'>
                                <button data-id='${item.id}' class="btn delete-item btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    `;

            });
            $("#cart_items").html(html);
            $(".cart-item .change-count").on("click", function() {
                let cart_item_id = parseInt($(this).data('id'));
                let qty = parseInt($(this).data('qty'));
                let action = $(this).data('action');
                $.ajax({
                    url:`${url}modify_cart.php`,
                    method: 'get',
                    data:{cart_item_id, qty, action},
                    dataType: 'json',
                    success:function(response) {
                        if(response.status == 200) {
                           location.reload();
                        }
                    }
                });
            });
            $(".cart-item .delete-item").on("click", function() {
                let cart_item_id = parseInt($(this).data('id'));
                let action = 'delete';
                $.ajax({
                    url: `${url}modify_cart.php`,
                    method: 'get',
                    data: {cart_item_id, action},
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            location.reload();
                        }
                    }
                });
            });
        }
        $.ajax({
            url:`${url}select_cart_items.php`,
            method:'get',
            data:{action:'get_cart_items'},
            dataType:'json',
            success: async function(response) {
                drawCart(response.data)
            },
            error:function (e) {
                console.log(e);
            }
        });


        //Accept
        $("#myForm").on("submit", function(event) {
            event.preventDefault();
            let products = [];
            $("#cart_items .cart-item").each(function(el) {
                products.push({
                    product_id:$(this).data('product_id'),
                    qty: parseInt($(this).find('.product-qty>strong').text()),
                    price: $(this).data('product_price'),
                });
            });
            const data = {
                products:JSON.stringify(products),
                full_name:$("#full_name").val(),
                phone:$("#phone").val(),
                address:$("#address").val(),
                comments:$("#comment").val()
            }


            $.ajax({
                url:`${url}create_order.php`,
                method:'post',
                data,
                dataType:'json',
                success:function(response) {
                    alert(response.message)
                }
            });
        })


    });

</script>
</body>
</html>
