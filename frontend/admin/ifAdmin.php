<?php

    if($_SESSION['user_role'] != 'admin'){
        header('location: ./../profile.php');
    }