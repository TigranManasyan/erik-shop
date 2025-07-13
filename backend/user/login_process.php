<?php
include "./../db.php";
session_start();
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $select = mysqli_query($conn, $sql);
    if(mysqli_num_rows($select) > 0){
        $user = mysqli_fetch_assoc($select);
    }
    if(password_verify($password, $user['password'])){
        $_SESSION['user'] = $user;
        if($user['role_id'] == 1) {
                    $_SESSION['user_role'] = 'admin';
                    header("location:./../../frontend/admin/dashboard.php");
                } else{
                    $_SESSION['user_role'] = 'user';
                    header("location:./../../frontend/profile.php");
                }

                exit;
    } else {
                $_SESSION['msg'] = [
                    'type' => 'login_fail',
                    'text' => 'Սխալ մուտքանուն կամ ծածկագիր'
                ];
                header("location:./../../frontend/user/index.php");
                exit;
            }
        } else {
            $_SESSION['msg'] = [
                'type' => 'login_fail',
                'text' => 'Սխալ մուտքանուն կամ ծածկագիր'
            ];
            header("location:./../../frontend/user/index.php");
            exit;
        }
?>