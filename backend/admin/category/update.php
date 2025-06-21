<?php
include "./../../db.php";
include "./../../helper.php";
session_start();
if(isset($_POST['name']) && isset($_POST['description'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $unique_query = mysqli_query($conn, "SELECT * FROM categories WHERE name = '$name'");
    if(mysqli_num_rows($unique_query) > 0) {
        $_SESSION['msg'] = [
            'type' => 'category_exists',
            'text' => 'Նշված անունով կատեգորիան արդեն գոյություն ունի'
        ];
        header('location: ./../../../frontend/admin/category/create.php');
        exit;
    }

    if(!empty($_POST['name'])) {
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $user_id = $_SESSION['user']['id'];
        $new_category_query = mysqli_query($conn, "UPDATE categories SET name='$name', description='$description' WHERE id=$category_id");
        if($new_category_query) {
            $_SESSION['msg'] = [
                'type' => 'create_success',
                'text' => 'Կատեգորիան հաջողությամբ թարմացվել է'
            ];
            header('location: ./../../../frontend/admin/category/index.php');
            exit;
        }
    } else {
        $_SESSION['required_field'] = 'Այս դաշտը պարտադիր պետք է լրացնել';
        header('location: ./../../../frontend/admin/category/create.php');
        exit;
    }

}