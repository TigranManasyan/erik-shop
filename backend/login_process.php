<?php
    include "./helper.php";
    include "./db.php";
    session_start();
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($query_user) > 0){
            $user = mysqli_fetch_assoc($query_user);
            if(password_verify($password, $user['password'])){
                $_SESSION['user'] = $user;
                if($user['role_id'] == 1) {
                    $_SESSION['user_role'] = 'admin';
                    header("location:./../frontend/admin/dashboard.php");
                } else{
                    $_SESSION['user_role'] = 'user';
                    header("location:./../frontend/user/profile.php");
                }

                exit;
            } else {
                $_SESSION['msg'] = [
                    'type' => 'login_fail',
                    'text' => 'Սխալ մուտքանուն կամ ծածկագիր'
                ];
                header("location:./../frontend/index.php");
                exit;
            }
        } else {
            $_SESSION['msg'] = [
                'type' => 'login_fail',
                'text' => 'Սխալ մուտքանուն կամ ծածկագիր'
            ];
            header("location:./../frontend/index.php");
            exit;
        }
    }