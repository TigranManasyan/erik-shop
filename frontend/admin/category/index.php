<?php
    include("./ifAdmin.php");
    include("./../../../backend/db.php");
    $sql = "SELECT categories.*, users.first_name, users.last_name FROM categories INNER JOIN users ON categories.user_id = users.id ORDER BY id DESC";
    $res = mysqli_query($conn, $sql);
    $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
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
                <h3>Categories</h3>
                <a class="btn btn-primary btn-sm" href="./create.php">Create New Category</a>
            </div>
            <div class="row">
                <?php include("./../../messages.php");?>
                <div class="col-md-12 d-flex flex-wrap-wrap">
                    <?php foreach ($categories as $category): ?>
                        <div class="card" style="width: 18rem;margin:10px">
                            <div class="card-header">
                                <h3><?= $category['name']; ?></h3>
                                <p style="font:12px Tahoma; color:grey"> Author` <?= $category['first_name']; ?> <?= $category['last_name']; ?></p>
                            </div>
                            <div class="card-body">
                                <?php if($category['user_id'] == $_SESSION['user']['id']): ?>
                                    <a class="btn btn-success btn-sm" href="./edit.php?id=<?= $category['id'] ?> ">Edit</a>
                                    <a data-id="<?= $category['id'] ?>" class="del btn btn-danger btn-sm" href="#">Delete</a>
                                <?php else: ?>
                                    <p>Not action</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
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