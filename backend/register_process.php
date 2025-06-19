<?php
    include "./helper.php";
    include "./db.php";
    session_start();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $unique_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($unique_query) > 0) {
            $_SESSION['msg'] = [
                'type' => 'user_exists',
                'text' => 'Դուք արդեն գրանցված եք, խնդրում ենք մուտք գործեք'
            ];
            header('location: index.php');
            exit;
        }

        if(isset($_POST['name']) && isset($_POST['password'])) {
            $name = $_POST['name'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user_reg_query = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
            if($user_reg_query) {
                $_SESSION['msg'] = [
                    'type' => 'register_success',
                    'text' => 'Գրանցումը հաջողությամբ կատարվել է'
                ];
                header('location: index.php');
                exit;
            } else {
                $_SESSION['msg'] = [
                    'type' => 'register_fail',
                    'text' => 'Գրանցումը չի կատարվել խնդրում ենք կրկին փորձել'
                ];
                $_SESSION['input_name'] = $name;
                $_SESSION['input_email'] = $email;
                $_SESSION['input_password'] = $_POST['password'];
                header('location: register.php');
                exit;
            }
        }



    }