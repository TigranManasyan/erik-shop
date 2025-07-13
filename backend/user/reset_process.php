<?php
include "./../db.php";
include "./../helper.php";
session_start();
if(!isset($_SESSION['user'])) {
    header('location: ./../../frontend/user/index.php'); exit;
}

if(isset($_POST['old_password'])) {
    $old_password = $_POST['old_password'];
    if(password_verify($old_password, $_SESSION['user']['password'])){
        if(isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            if($_POST['new_password'] == $_POST['confirm_password']) {
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $user_id = $_SESSION['user']['id'];
                $user_role = $_SESSION['user']['role_id'];
                $res = query("UPDATE users SET password = '$new_password' WHERE id = $user_id");
                if($res) {
                    $_SESSION['msg'] = [
                        'type' => 'reset_success',
                        'text' => 'Ծածկագիրը հաջողությամբ թարմացվել է'
                    ];
                    if($user_role == 1) {
                        header("location:http://localhost/time_to_code_lessons/Erik/shop/frontend/admin/dashboard.php"); exit;
                    } else if($user_role == 2){
                        header("location:http://localhost/time_to_code_lessons/Erik/shop/frontend/user/profile.php"); exit;
                    }
                } else {
                    $_SESSION['msg'] = [
                        'type' => 'reset_fail',
                        'text' => 'Թարմացումը չի կատարվել, փորձեք կրկին'
                    ];
                    header("location:http://localhost/time_to_code_lessons/Erik/shop/frontend/reset.php"); exit;

                }
            } else {
                $_SESSION['msg'] = [
                    'type' => 'reset_fail',
                    'text' => 'Ծածկագրերը չեն համնկնում'
                ];
                header("location:http://localhost/time_to_code_lessons/Erik/shop/frontend/reset.php"); exit;

            }
        }
    } else {
        $_SESSION['msg'] = [
            'type' => 'reset_fail',
            'text' => 'Ծածկագրը սխալ է'
        ];
        header("location:http://localhost/time_to_code_lessons/Erik/shop/frontend/reset.php"); exit;

    }
}

