<?php
include("./ifAdmin.php");
include("./../../../backend/db.php");
if(isset($_GET["id"])){
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    $res1 = mysqli_query($conn, "SELECT * FROM categories");
    $categories = mysqli_fetch_all($res1, MYSQLI_ASSOC);
    if(mysqli_num_rows($res) > 0) {
        $product = mysqli_fetch_assoc($res);
    } else {
        $_SESSION['msg'] = [
            'type' => 'warning',
            'text' => "$id-ով կատեգորիան գոյույթյուն չունի"
        ];
        header("location:./index.php");
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    <?php include("./../../bootstrap.php"); ?>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align:center">Edit Product</h2>
            <div style="text-align:center">
                <img style="width: 300px;" src="./../../../backend/admin/uploads/<?= $product['image'];?>">
            </div>
            <form action="./../../../backend/admin/product/update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$product['id']?>">
                <div class="form-group mb-3">
                    <label class="form-label" for="image">Product Image</label>
                    <input type="file" name="image" class="form-control"  >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $product['name']?>" placeholder="Product" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="form-group mb-3">
                    <label for="category_id" class="form-label">Choose Category name <sup style="color:red;font-size: 16px"> *</sup></label>
                    <select name="category_id"  id="category_id" class="form-control">
                        <?php foreach ($categories as $category): ?>
                            <option <?php if($category['id'] == $product['category_id']) { echo "selected"; } ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if(isset($_SESSION['required_field'])): ?>
                        <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="price">Product Price</label>
                    <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" placeholder="Price" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label" for="qty">Product Quantity</label>
                    <input type="number" name="qty" class="form-control" value="<?= $product['qty'] ?>" placeholder="Quantity" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="form-group mb-3">
                    <label for="is_active" class="form-label">Active<sup style="color:red;font-size: 16px"> *</sup></label>
                    <select name="is_active"  id="is_active" class="form-control">
                       <option <?php if($product['is_active'] == 1) { echo "selected"; } ?> value="<?= 1?>"><?= "Yes" ?></option>
                            <option <?php if($product['is_active'] == 0) { echo "selected"; } ?> value="<?= 0 ?>"><?= "No" ?></option>
                    </select>
                    <?php if(isset($_SESSION['required_field'])): ?>
                        <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea name="description" class="form-control" aria-label="With textarea"><?= $product['description'] ?></textarea>
                </div>
                <button class="btn btn-primary btn-sm">Save</button>
            </form>
        </div>
    </div>
</div>



</body>
</html>