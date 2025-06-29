<?php
session_start();
$user_role = $_SESSION['user']['role_id'];
session_destroy();
if($user_role == 1) {
    header("location:./../frontend/index.php");
} else if($user_role == 2 ) {
    header("location:./../frontend/user/index.php");
}
