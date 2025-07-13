<?php
include("./../../db.php");
include("./../../helper.php");
session_start();
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$action = $_GET['action'];
$user_id = $_SESSION['user']['id'];
if($action == 'get_cart_count') {
    $SQL_COUNT = "SELECT COUNT(*) AS cart_count FROM cart_items WHERE user_id = '$user_id'";
    $result = query($SQL_COUNT);
    $row = mysqli_fetch_assoc($result);
    echo json_encode([
        'cart_count' => $row['cart_count'],
        'status' => 200
    ]);
} elseif($action == 'get_cart_items') {
    $SQL_ITEMS = "SELECT cart_items.*, products.id AS product_id, products.name, products.price, products.image FROM cart_items INNER JOIN products ON cart_items.product_id = products.id WHERE cart_items.user_id = '$user_id'";
    $result = query($SQL_ITEMS);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode([
        'data' => $rows,
        'status' => 200
    ]);
}