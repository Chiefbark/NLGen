<?php
require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";
require_once "assets/BackEnd/Newsletter.php";
require_once "assets/BackEnd/DAONewsletter.php";

$list = NewsletterList::select();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletters | NLGen</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column" onclick="onBodyClicked()">
    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
        <div class="container d-flex">
            <div class="flex-grow-1">
                <a class="navbar-brand" href="index.php">NLGen</a>
            </div>
            <div class="mr-auto">
                <a href="newsletters.php" class="btn btn-link text-white text-decoration-none">Newsletters</a>
            </div>
        </div>
    </nav>

    <div class="container flex-grow">
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