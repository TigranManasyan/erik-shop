<?php
include("./../../db.php");
include("./../../helper.php");
session_start();
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$user_id = $_SESSION["user"]['id'];
$products = json_decode($_POST['products'], true);
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$comments = $_POST['comments'];

$insert_order = query("INSERT INTO orders (user_id, full_name, phone, address, comments) VALUES ($user_id, '$full_name', '$phone', '$address', '$comments')");
$order_id = mysqli_insert_id($conn);
foreach ($products as $product) {
    $total = $product['qty'] * $product['price'];
    $insert_order_item = query("INSERT INTO order_items (order_id, product_id, qty, price, total) VALUES ($order_id, {$product['product_id']}, {$product['qty']}, {$product['price']}, $total )");
}

echo json_encode([
    'status' => 200,
    'message' => 'Order created!'
]);