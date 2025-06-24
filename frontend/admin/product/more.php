<?php
    include "./../../../backend/helper.php";
    include("./../../../backend/db.php");
if(isset($_GET['id']) && isset($_GET['img'])){
    $id = $_GET['id'];
    $img = $_GET['img'];
    $select = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    if(mysqli_num_rows($select) < 1){
        echo "The product doesn't existe";
        exit;
}else if(mysqli_num_rows($select) > 1){
        echo "The product already existe";
        exit;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More</title>
    <?php include("./../../bootstrap.php"); ?>
</head>
<body>
<a href="./product_edit.php?id=<?=$id;?>&img=<?=$img;?>" class="btn btn-primary btn-sm">Edit</a>
<a href="./delete_select.php?id=<?=$id;?>&img=<?=$img;?>" class="btn btn-primary btn-sm">Delete</a>
</body>
</html>