<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";

$list = PostList::select();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | NLGen</title>

    <script>
        function filterPosts() {
            var value = document.getElementById('search-field').value.toLowerCase();
            var items = document.querySelectorAll('.card');
            for (var item of items)
                item.classList.remove('hidden');

            var items = document.querySelectorAll('.card:not([title*="' + value + '"])');
            if (value && items)
                for (var item of items)
                    item.classList.add('hidden');
        }
    </script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">NLGen</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subscribe.php">Subscribe</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container flex-grow">
        <div class="row">
            <h3 class="col-md-8">Browse over all our posts</h3>
            <div class="input-group mb-3 col-md-4">
                <input type="text" class="form-control" id="search-field" placeholder="Search..." aria-label="name" onkeyup="filterPosts()">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <span id="search-icon">&#9906;</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-columns py-2">
            <?php
            echo $list->toHTML();
            ?>
        </div>
    </div>

    <footer class="py-5 bg-dark mt-4">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; NLGen 2020</p>
        </div>
    </footer>

</body>

</html>