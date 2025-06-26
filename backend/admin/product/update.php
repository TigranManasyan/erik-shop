<?php
include "./../../db.php";
include "./../../helper.php";
session_start();
$upload_dir = './../../../backend/admin/uploads';
if(isset($_POST['name'])
    && isset($_POST['description'])
    && isset($_POST['price'])
    && isset($_POST['category_id'])
    && isset($_POST['qty'])
    && isset($_POST['is_active'])
) {
    $id = $_POST['id'];
    $res = mysqli_query($conn, "SELECT image from products where id = $id");
    $product = mysqli_fetch_assoc($res);
    $file_name = $product['image'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $qty = $_POST['qty'];
    $is_active = $_POST['is_active'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user']['id'];
    if(!empty($_FILES['image']['name'])) {
        $file = $_FILES['image'];
        if(file_exists("./../uploads/$file_name")) {
            unlink("./../uploads/$file_name");
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if(!in_array($ext, array("jpg", "jpeg", "png"))){
            $_SESSION['image_format'] = 'Format image is jpg, jpeg or png';
            header('location: ./../../../frontend/admin/product/edit.php?id='.$id);
            exit;
        }
        $file_name = time() . '_' . $_SESSION['user']['id'] . '.' . $ext;
        move_uploaded_file($file['tmp_name'], $upload_dir . '/' . $file_name);
    }
        $sql = "UPDATE products SET name = '$name', price=$price, category_id = $category_id, qty = $qty, is_active = $is_active, description='$description', image='$file_name' WHERE id = $id";

        if(query($sql)) {
            $_SESSION['msg'] = [
                'type' => 'create_success',
                'text' => 'Product has been updated successfully!'
            ];
            header('location: ./../../../frontend/admin/product/index.php');
            exit;
        }
}