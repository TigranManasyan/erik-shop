<?php session_start();
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
    <title>Register</title>
    <?php include "./../bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2 class="text-center mt-2 mb-2">SING UP</h2>
            <?php include "./../messages.php"; ?>
            <form action="./../../backend/user/register_process.php" method="post">
                <div class="form-group">
                    <label for="firstname" class="form-label">First Name</label>
                    <input value="<?php echo isset($_SESSION['input_firstname']) ? $_SESSION['input_firstname'] : ''; ?>" type="text" name="firstname" id="firstname" class="form-control" placeholder="John">
                </div>
                <div class="form-group">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input value="<?php echo isset($_SESSION['input_lastname']) ? $_SESSION['input_lastname'] : ''; ?>" type="text" name="lastname" id="lastname" class="form-control" placeholder="Smith">
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input value="<?php echo isset($_SESSION['input_phone']) ? $_SESSION['input_phone'] : ''; ?>" type="text" name="phone" id="phone" class="form-control" placeholder="+374 123456">
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
                    <a href="./index.php" class="text-center">Account Exists?</a>
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