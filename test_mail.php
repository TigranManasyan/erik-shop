<?php
    $to = "er.avet1syann@gmail.com";
    $headers = '';
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$subject = "Test Mail";
$message = "Hello I am Test Mail";
$message = "<p>Ձեր վավերացման կոդն է<strong>ssss</strong>:</p>";
$headers .= "From: manasyan.tigran@mail.ru";
    if(mail($to, $subject, $message, $headers)){
        echo "Mail sent successfully";
    } else {
        echo "Mail sending failed";
    }