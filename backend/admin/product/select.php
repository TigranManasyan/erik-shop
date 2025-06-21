<?php
include "./../../db.php";
include "./../../helper.php";
session_start();
$res = query("SELECT products.user_id, products.name AS product_name, products.image, products.id, categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id");
$response = [
    'status' => 200,
    'data' => mysqli_fetch_all($res, MYSQLI_ASSOC),
];

echo json_encode($response);