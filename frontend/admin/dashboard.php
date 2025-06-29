<?php
session_start();
include("./ifAdmin.php"); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <?php include("./../bootstrap.php"); ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex">
            <ul>
                <li><a href="./category/index.php">Categories</a> </li>
                <li><a href="./product/index.php">Products</a></li>
                <li><a href="./../../backend/logout_process.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>