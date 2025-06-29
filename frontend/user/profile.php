<?php
    session_start();
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        $_SESSION['msg'] = [
            'type' => 'auth_fail',
            'text' => 'Խնդրում ենք մուտք գործել'
        ];
        header("location:./index.php");
        exit;
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <?php include "./../bootstrap.php"; ?>

</head>
<body>
<?php include "./navbar.php"; ?>
    <div class="container">


    </div>
</body>
</html>
