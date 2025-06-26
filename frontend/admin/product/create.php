<?php
include("./ifAdmin.php");
include("./../../../backend/db.php");
$res = mysqli_query($conn, "SELECT * FROM categories");
$categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Product</title>
    <?php include("./../../bootstrap.php"); ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-baseline">
            <h3>New Product</h3>
            <a class="btn btn-secondary btn-sm" href="./index.php">All Products</a>
        </div>
        <div class="row">
            <?php include("./../../messages.php");?>
            <div class="col-md-12">
                <form action="./../../../backend/admin/product/insert.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Choose Category name <sup style="color:red;font-size: 16px"> *</sup></label>
                        <select name="category_id"  id="category_id" class="form-control">
                            <option  disabled selected>-- Select Category --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="name" class="form-label">Product name <sup style="color:red;font-size: 16px"> *</sup></label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Product">
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="price" class="form-label">Product price <sup style="color:red;font-size: 16px"> *</sup></label>
                        <input id="price" name="price" type="text" class="form-control" placeholder="Price">
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="qty" class="form-label">Product quantity <sup style="color:red;font-size: 16px"> *</sup></label>
                        <input id="qty" name="qty" type="number" min="1" value="1" class="form-control" placeholder="Quantity">
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="is_active" class="form-label">Choose Active <sup style="color:red;font-size: 16px"> *</sup></label>
                        <select name="is_active"  id="is_active" class="form-control">
                            <option  disabled selected>-- Select Active --</option>
                                <option value="<?= 1?>"><?= "Yes" ?></option>
                                <option value="<?= 0 ?>"><?= "No" ?></option>
                        </select>
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="image" class="form-label">Product image <sup style="color:red;font-size: 16px"> *</sup></label>
                        <input id="image" name="image" type="file"  class="form-control">
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php elseif(isset($_SESSION['image_format'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['image_format']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-2">
                        <label for="description" class="form-label">Category description</label>
                        <textarea name="description" id="description" style="resize: none" cols="30" rows="5" class="form-control" placeholder="Description body"></textarea>
                    </div>
                    <button class="mt-2 btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>