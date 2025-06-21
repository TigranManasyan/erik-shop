<?php
include("./ifAdmin.php");
include("./../../../backend/db.php");
if(isset($_GET["id"])){
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM categories WHERE id = $id");
    if(mysqli_num_rows($res) > 0) {
        $category = mysqli_fetch_assoc($res);
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
        <div class="col-md-12 d-flex justify-content-between align-items-baseline">
            <h3>Edit Category</h3>
            <a class="btn btn-secondary btn-sm" href="./index.php">All Categories</a>
        </div>
        <div class="row">
            <?php include("./../../messages.php");?>
            <div class="col-md-12">
                <form action="./../../../backend/admin/category/update.php" method="post">
                    <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                    <div class="form-group">
                        <label for="name" class="form-label">Category name <sup style="color:red;font-size: 16px"> *</sup></label>
                        <input id="name" name="name" type="text" class="form-control" value="<?= $category['name'] ?>" placeholder="Category">
                        <?php if(isset($_SESSION['required_field'])): ?>
                            <p style="font:italic 12px Tahoma" class="text-danger"><?= $_SESSION['required_field']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-2">
                        <label for="description" class="form-label">Category description</label>
                        <textarea name="description" id="description" style="resize: none" cols="30" rows="5" class="form-control" placeholder="Description body"><?= $category['description'] ?></textarea>
                    </div>
                    <button class="mt-2 btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>