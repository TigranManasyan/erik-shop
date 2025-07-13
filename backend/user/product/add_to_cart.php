<?php

include("./../../db.php");
include("./../../helper.php");
session_start();
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user']['id'];
$res = query("SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $product_id");
if(mysqli_num_rows($res) > 0) {
    $cart_item = mysqli_fetch_assoc($res);
    $qty = $cart_item['qty'] + 1;
    $id = $cart_item['id'];
    $SQL_UPDATE_CART = "UPDATE cart_items SET qty = $qty WHERE id = $id";
    query($SQL_UPDATE_CART);
    echo json_encode([
        'msg' => 'Քանակը մեկով ավելացել է',
        'status' => 200
    ]);
    exit;
}
$SQL_ADD_TO_CART = query("INSERT INTO cart_items (user_id, product_id) VALUES ($user_id, $product_id)");

echo json_encode([
    'msg' => 'Տվյալները ավելացել են զամբյուղի մեջ',
    'status' => 200
]);