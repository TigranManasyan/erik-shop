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
        $user_id = $_SESSION['user']['id'];
        $new_category_query = mysqli_query($conn, "INSERT INTO categories (name, description, user_id) VALUES ('$name', '$description', $user_id)");
        if($new_category_query) {
            $_SESSION['msg'] = [
                'type' => 'create_success',
                'text' => 'Կատեգորիան հաջողությամբ ստեղծվել է'
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