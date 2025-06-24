<?php
    include("./../../../backend/db.php");
    if(isset($_GET['id']) && isset($_GET['img'])){
    $id = $_GET['id'];
    $img = $_GET['img'];
    $select = mysqli_query($conn, "SELECT products.* , categories.name AS category_name FROM categories INNER JOIN products ON categories.id=products.category_id WHERE products.id=$id");
        if(mysqli_num_rows($select) < 1){
        echo "The product doesn't existe";
        exit;
}else if(mysqli_num_rows($select) > 1){
        echo "The product already existe";
        exit;
}else if($select){
    foreach($select as $select){
    $name = $select['name'];
    $price = $select['price'];
    $qty = $select['qty'];
    $image = $select['image'];
    $description = $select['description'];
    $category_id = $select['category_id'];
    $category_name = $select['category_name'];
}
}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
    <?php include("./../../bootstrap.php"); ?>
</head>
<body>
    <h2 style="text-align:center">Edit Product</h2>
    <div style="text-align:center">
        <img style="width: 300px;" src="./../../../backend/admin/uploads/<?=$img;?>">
    </div>
    <form action="./product_edit_process.php" method="post">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="category_id" value="<?=$category_id?>">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Product Name</span>
            <input type="text" name="name" class="form-control" value="<?=$name?>" placeholder="Product" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Product Category</span>
            <input type="text" name="category_name" class="form-control" value="<?=$category_name?>" placeholder="Category" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Product Price</span>
            <input type="text" name="price" class="form-control" value="<?=$price?>" placeholder="Price" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Product Quantity</span>
            <input type="text" name="qty" class="form-control" value="<?=$qty?>" placeholder="Quantity" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group">
            <span class="input-group-text">Description</span>
            <textarea name="description" class="form-control" aria-label="With textarea"><?=$description?></textarea>
        </div>
        <button class="btn btn-primary btn-sm">Save</button>
    </form>
    
</body>
</html>