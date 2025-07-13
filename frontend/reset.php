<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php session_start(); include('./bootstrap.php'); ?>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Reset Password</h2>
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col-md-12">
                <?php include "./messages.php"; ?>
                <form action="http://localhost/time_to_code_lessons/Erik/shop/backend/user/reset_process.php" method="post">
                    <div class="form-group">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input id="old_password" type="password" name="old_password" placeholder="Enter old password please" class="form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <input id="new_password" type="password" name="new_password" placeholder="Enter new password please" class="form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Enter new password again please" class="form-control">
                    </div>
                    <div class="mt-2 form-group">
                        <button id="generate_password" type="button" class="btn btn-primary">Generate New Password</button>
                        <button id="show" type="button" class="btn btn-secondary">Show</button>
                        <button class="btn btn-success">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <script>
        jQuery(document).ready(function($) {
            function generatePassword(length = 6) {
                let str = '0123456789!@#$%^&*()';
                let output = '';
                for(let i = 1; i <= length; i++) {
                    let random = Math.round(Math.random() * (str.length - 1));
                    output += str[random];
                }
                return output;
            }

            $(document).on("click", "#generate_password", function() {
                let pass = generatePassword();
                $("#new_password").val(pass);
                $("#confirm_password").val(pass);
            });

            $(document).on("click", "#show", function() {
                $("#old_password").attr('type', 'text');
                $("#new_password").attr('type', 'text');
                $("#confirm_password").attr('type', 'text');
            });

        })
    </script>
</body>
</html>