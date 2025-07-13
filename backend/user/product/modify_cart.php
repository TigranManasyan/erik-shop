<?php
include("./../../db.php");
include("./../../helper.php");
session_start();
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$action = $_GET['action'];
$user_id = $_SESSION['user']['id'];



if($action == 'plus' || $action == 'minus') {
    $cart_item_qty = $_GET['qty'];
    $cart_item_id = $_GET['cart_item_id'];
    if($action == 'plus') {
        $cart_item_qty++;
    } else {
        $cart_item_qty--;
    }

    query("UPDATE cart_items SET qty = $cart_item_qty WHERE id = $cart_item_id ");
    echo json_encode(['status' => 200]);
} else if($action == 'delete') {
    $cart_item_id = $_GET['cart_item_id'];
    query("DELETE FROM cart_items WHERE id = $cart_item_id ");
    echo json_encode(['status' => 200]);
}