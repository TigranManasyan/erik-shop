<?php
    include "./helper.php";
    session_start();
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        $_SESSION['msg'] = [
            'type' => 'auth_fail',
            'text' => 'Խնդրում ենք մուտք գործել'
        ];
        header("location:./index.php");
        exit;
    }
    include "./db.php";
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ստեղծել նոր հրապարակում</title>
        <?php include "./bootstrap.php"; ?>

    </head>
    <body>
        <div class="container">
            <div class="w-25">
                <form action="./post_process.php" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-2">
                        <label class="form-label" for="title">Վերնագիր</label>
                        <input class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="body">Բովանդակություն</label>
                        <textarea id="body" class="form-control" name="body"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label class=form-label for="post_img">Նկար/Տեսանյութ</label>
                        <input class="form-control" type="file" id="post_img" name="post_img">
                    </div>
                    <button class="btn btn-primary">Հրապարակել</button>
                </form>
            </div>
        </div>
        
    </body>
    </html>