<?php
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
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $select = "SELECT * FROM posts WHERE posts.user_id={$user['id']} AND posts.title LIKE '%$search%'";
    } else {
        $select = "SELECT * FROM posts WHERE posts.user_id={$user['id']}";
    }
    $result = mysqli_query($conn, $select);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <?php include "./bootstrap.php"; ?>

</head>
<body>
<?php include "./navbar.php"; ?>
    <div class="container">

        <form class="d-flex mt-2" role="search" method="get" action="">
            <input class="form-control me-2" type="search" placeholder="Որոնել․․․" name="search" aria-label="Search"/>
            <button class="btn btn-outline-success" type="submit">Որոնել</button>
        </form>
        <a href="./new_post.php">Ստեղծել նոր հրապարակում</a><br>
        <h2>Իմ հրապարակումները</h2>
            <?php foreach($posts as $post){ ?>
                <div class="card" style="">
                    <img src="./uploads/<?php echo $post['post_img']; ?>" class="card-img-top" alt="<?php echo $post['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post['title']; ?></h5>
                        <p class="card-text"><?php echo $post['body']; ?></p>
                    </div>
                    <div class="card-footer">
                        <?php echo $post['created_at']; ?>
                    </div>
                </div>
            <?php } ?>
    </div>
</body>
</html>
