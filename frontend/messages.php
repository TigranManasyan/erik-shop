<div class="msg">
    <?php
        if(isset($_SESSION['msg'])) {
            switch ($_SESSION['msg']['type']) {
                case 'user_exists':
                    echo "<div class='alert alert-danger'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'register_success':
                    echo "<div class='alert alert-success'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'register_fail':
                    echo "<div class='alert alert-warning'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'login_fail':
                    echo "<div class='alert alert-warning'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'auth_fail':
                    echo "<div class='alert alert-warning'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'post_success':
                    echo "<div class='alert alert-success'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'post_fail':
                    echo "<div class='alert alert-warning'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'category_exists':
                    echo "<div class='alert alert-warning'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
                case 'create_success':
                    echo "<div class='alert alert-success'>" . $_SESSION['msg']['text'] . "</div>";
                    break;
            }
            unset($_SESSION['msg']);
        }
    ?>
</div>