<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./profile.php">ԳԼԽԱՎՈՐ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./other_posts.php">Հրապարակումներ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true" href="./logout_process.php"><?php echo $user['name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout_process.php">Դուրս Գալ</a>
                </li>
            </ul>
<!--            <form class="d-flex" role="search">-->
<!--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>-->
<!--                <button class="btn btn-outline-success" type="submit">Search</button>-->
<!--            </form>-->
        </div>
    </div>
</nav>