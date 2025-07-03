<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://localhost/time_to_code_lessons/Erik/shop/frontend/user/profile.php">ԳԼԽԱՎՈՐ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://localhost/time_to_code_lessons/Erik/shop/frontend/user/product/index.php">ԱՊՐԱՆՔՆԵՐ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true" href="#"><?= $user['first_name']; ?> <?= $user['last_name']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/time_to_code_lessons/Erik/shop/frontend/user/cart/index.php" class="nav-link" >My Cart <span id="cart_count">0</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./../../backend/logout_process.php">Դուրս Գալ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    jQuery(document).ready(function($) {
        $.ajax({
            url:'http://localhost/time_to_code_lessons/Erik/shop/backend/user/product/select_cart_items.php',
            method:'get',
            dataType:'json',
            data:{action:'get_cart_count'},
            success:function(response) {
                $("#cart_count").html(response.cart_count);
            }
        })
    })
</script>