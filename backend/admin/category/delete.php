<?php
include "./../../db.php";
include "./../../helper.php";
session_start();
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(query( "DELETE FROM categories WHERE id = $id")) {
         echo json_encode([
             'status' => 200,
             'message' => 'Category has been deleted'
         ]);
    }


}