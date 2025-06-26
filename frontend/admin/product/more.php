<?php
    include "./../../../backend/helper.php";
    include("./../../../backend/db.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $message ="";
    $sql = "SELECT pr.*, us.first_name AS author_first_name, us.last_name AS author_last_name, cat.name AS category FROM products AS pr 
    INNER JOIN categories AS cat ON pr.category_id = cat.id 
    INNER JOIN users AS us ON pr.user_id = us.id 
                                  WHERE pr.id=$id";
    $select = mysqli_query($conn, $sql);
    if(mysqli_num_rows($select) > 0){
        $product = mysqli_fetch_assoc($select);
    } else {
        $message = "The product doesn't exist";
    }
}
if($product['is_active'] == 1){
    $active_product = "Yes";
}else{
       $active_product = "No";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More</title>
    <?php include("./../../bootstrap.php"); ?>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
</head>
<body>
<div class="container">
    <img src="./../../../backend/admin/uploads/<?= $product['image'] ?>" alt="">
    <h2>Product name` <?= $product['name'] ?></h2>
    <p>Category` <?= $product['category'] ?></p>
    <p>Price` <?= $product['price'] ?>AMD</p>
    <p>Quantity` <?= $product['qty'] ?></p>
    <p>Description` <?= $product['description'] ?></p>
    <p>Active` <?=$active_product?></p>
    <p>Created by` <?= $product['author_first_name'] ?> <?= $product['author_last_name'] ?></p>
    
    <a href="./edit.php?id=<?=$product['id']?>" class="btn btn-success btn-sm">Edit</a>
    <a href="#" class="btn btn-danger btn-sm del">Delete</a>
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
                url:'./../../../backend/admin/product/delete.php',
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