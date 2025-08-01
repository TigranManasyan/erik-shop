<?php
    include "./../helper.php";
    include "./../db.php";
    session_start();

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $unique_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($unique_query) > 0) {
            $_SESSION['msg'] = [
                'type' => 'user_exists',
                'text' => 'Դուք արդեն գրանցված եք, խնդրում ենք մուտք գործեք'
            ];
            header('location: ./../../frontend/user/register.php');
            exit;
        }

        if(isset($_POST['firstname']) && isset($_POST['phone']) &&  isset($_POST['lastname']) && isset($_POST['password'])) {
            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $phone = $_POST['phone'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user_reg_query = mysqli_query($conn, "INSERT INTO users (first_name, last_name, phone, email, password, role_id) VALUES ('$first_name','$last_name','$phone', '$email', '$password', 2)");
            if($user_reg_query) {
                $code = random_code(4);
                $_SESSION['verify_code'] = $code;
                $_SESSION['registered_id'] = mysqli_insert_id($conn);
                $headers = '';
                $subject = 'Verification code';

                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $headers .= "From: manasyan.tigran@mail.ru";
                $message = "<p>Ձեր վավերացման կոդն է <strong>$code</strong>:</p>";

                mail($email, $subject, $message, $headers);
                $_SESSION['msg'] = [
                    'type' => 'register_success',
                    'text' => 'Գրանցումը հաջողությամբ կատարվել է, խնդրում ենք ստուգեք Ձեր էլ․ հասցեն'
                ];
                header('location: ./../../frontend/user/verify.php');
                exit;
            } else {
                $_SESSION['msg'] = [
                    'type' => 'register_fail',
                    'text' => 'Գրանցումը չի կատարվել խնդրում ենք կրկին փորձել'
                ];
                $_SESSION['input_name'] = $name;
                $_SESSION['input_email'] = $email;
                $_SESSION['input_password'] = $_POST['password'];
                header('location: ./../../frontend/user/register.php');
                exit;
            }
        }



    }