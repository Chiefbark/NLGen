<?php
require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";

$post = new Post();

if (isset($_GET['id']) && !empty($_GET['id']))
    $post = Post::selectById($_GET['id']);
else
    header('location: index.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post | NLGen</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">NLGen</a>
        </div>
    </nav>

    <div class="container flex-grow">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <h1 class="mt-4"><?php echo $post->getTitle(); ?></h1>
                <p class="lead">
                    by <?php echo $post->getAuthor(); ?>
                </p>
                <hr>
                <p>Posted on <?php echo $post->getFullTime(); ?></p>
                <hr>
                <img class="img-fluid rounded" src="<?php echo $post->getPhoto(); ?>" alt="">
                <hr>
                <?php echo $post->getContent(); ?>
            </div>
        </div>
    </div>

    <footer class="py-5 bg-dark mt-4">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; NLGen 2020</p>
        </div>
    </footer>

</body>

</html>