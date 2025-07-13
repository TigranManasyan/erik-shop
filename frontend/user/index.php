<?php
    session_start();
    if(isset($_SESSION['user'])) {
        header("location:./../profile.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <?php include "./../bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2 class="text-center mt-2 mb-2">SING IN</h2>
            <?php include "./../messages.php"; ?>
            <form action="./../../backend/login_process.php" method="post">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="text-center mt-2 mb-2">
                    <a href="./register.php">Create account</a>
                </div>
                <button class="btn btn-primary">Sign In</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script src="./js/main.js"></script>
</body>
</html>