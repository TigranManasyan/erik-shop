<?php
    include "./../../db.php";
    include "./../../helper.php";
    session_start();
    $upload_dir = './../../../backend/admin/uploads';
if(isset($_POST['name'])
    && isset($_POST['description'])
    && isset($_POST['price'])
    && isset($_POST['category_id'])
    && isset($_FILES['image'])
    && isset($_POST['qty'])
) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $file = $_FILES['image'];
    $user_id = $_SESSION['user']['id'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    if(!in_array($ext, array("jpg", "jpeg", "png"))){

        $_SESSION['image_format'] = 'Format image is jpg, jpeg or png';
        header('location: ./../../../frontend/admin/product/create.php');
        exit;
    }
    if(!file_exists($upload_dir)){
        mkdir($upload_dir);
    }
    $file_name = time() . '_' . $_SESSION['user']['id'] . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $upload_dir . '/' . $file_name)){
        if(query("INSERT INTO products (user_id, name, price, category_id, qty, description, image) VALUES ($user_id, '$name', $price, $category_id, $qty, '$description', '$file_name')")) {
            $_SESSION['msg'] = [
                'type' => 'create_success',
                'text' => 'Product has been created'
            ];
            header('location: ./../../../frontend/admin/product/index.php');
            exit;
        }
    }
}