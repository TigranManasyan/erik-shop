<?php
include "./../../backend/db.php";
include "./../../backend/helper.php";
    session_start();
    if(isset($_POST['code'])) {
        $code = $_POST['code'];
        $user_id = $_SESSION['registered_id'];
        if($code == $_SESSION['verify_code']) {
            $q = query("UPDATE users SET is_verified = 1 WHERE id = $user_id");
            $_SESSION['msg'] = [
                'type' => 'verify_success',
                'text' => 'Վավերացումը հաջողությամբ կատարվել է'
            ];
            header('location: ./../../frontend/user/index.php');
            exit;
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="code" placeholder="Մուտքագրեք 4 նիշանոց կոդը։">
    <button>Հաստատել</button>
</form>
</body>
</html>
