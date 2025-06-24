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

