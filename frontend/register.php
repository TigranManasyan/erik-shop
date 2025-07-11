<?php session_start();
 if(isset($_SESSION['user'])) {
    header("location:./profile.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <?php include "./bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2 class="text-center mt-2 mb-2">SING UP</h2>
            <?php include "./messages.php"; ?>
            <form action="./register_process.php" method="post">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input value="<?php echo isset($_SESSION['input_name']) ? $_SESSION['input_name'] : ''; ?>" type="text" name="name" id="name" class="form-control" placeholder="John Smith">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input value="<?php echo isset($_SESSION['input_email']) ? $_SESSION['input_email'] : ''; ?>" type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input value="<?php echo isset($_SESSION['input_password']) ? $_SESSION['input_password'] : ''; ?>" type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="text-center mt-2 mb-2">
                    <a href="admin/index.php" class="text-center">Account Exists?</a>
                </div>
                <button class="btn btn-success">Sign Up</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script src="./js/main.js"></script>
</body>
</html>