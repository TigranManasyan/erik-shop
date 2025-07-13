<?php
    session_start();
    if($_SESSION['user_role'] != 'admin'){
        header('location: ./../../profile.php');
    }