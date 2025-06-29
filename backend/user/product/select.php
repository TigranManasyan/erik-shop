<?php
    include("./../../db.php");
    include("./../../helper.php");
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    $SQL_SELECT_PRODUCTS = query("SELECT products.*, categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.is_active = 1");
    $products = mysqli_fetch_all($SQL_SELECT_PRODUCTS, MYSQLI_ASSOC);
    echo json_encode([
        'data' => $products,
        'status' => 200
    ]);