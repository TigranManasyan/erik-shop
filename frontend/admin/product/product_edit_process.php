<?php
include("./../../../backend/db.php");

if(isset($_POST['id']) && isset($_POST['category_id']) && isset($_POST['category_name']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['qty']) && isset($_POST['description'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    if(empty($name)){
         $_SESSION['required_field_name'] = 'Այս դաշտը պարտադիր պետք է լրացնել';
        header('location: ./product_edit.php');
        exit;
    }
    if(empty($price)){
         $_SESSION['required_field_price'] = 'Այս դաշտը պարտադիր պետք է լրացնել';
        header('location: ./product_edit.php');
        exit;
    }
    if(empty($qty)){
         $_SESSION['required_field_qty'] = 'Այս դաշտը պարտադիր պետք է լրացնել';
        header('location: ./product_edit.php');
        exit;
    }
    else{
    $update = mysqli_query($conn, "UPDATE products SET name='$name', price=$price,qty=$qty, category_id=$category_id ,description='$description' WHERE id=$id");
    if($update){
        $update_category = mysqli_query($conn,"UPDATE categories SET name='$category_name' WHERE id=$id");}
        if($update_category){
        $_SESSION['edited_field'] = 'Saved';
        header("location:./index.php");
    }

}
}
?>