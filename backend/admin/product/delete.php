<?php
include "./../../db.php";
include "./../../helper.php";
session_start();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(query( "DELETE FROM products WHERE id = $id")) {
         echo json_encode([
             'status' => 200,
             'message' => 'Product has been deleted'
         ]);
    }


}