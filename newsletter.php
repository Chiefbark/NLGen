<?php
require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";
require_once "assets/BackEnd/Newsletter.php";
require_once "assets/BackEnd/DAONewsletter.php";

$newsletter = new Newsletter();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $newsletter = Newsletter::selectById($_GET['id']);
    if (!$newsletter)
        header('location: index.php');
} else
    header('location: index.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter | NLGen</title>

    <script>
        function onDropdownClicked(elem) {
            if (elem.nextElementSibling.style.display != 'block')
                elem.nextElementSibling.style.display = 'block';
            else
                elem.nextElementSibling.style.display = '';
        }

        function onBodyClicked() {
            if (!event.target.classList.contains('dropdown-menu') && !event.target.parentNode.classList.contains('dropdown-toggle') && !event.target.classList.contains('dropdown-toggle')) {
                var items = document.getElementsByClassName('dropdown-menu');
                for (elem of items)
                    elem.style.display = '';
            }
        }
    </script>

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
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="row px-3">
                    <div class="d-flex w-100 align-items-center">
                        <h1 class="flex-grow-1">Newsletter</h1>
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" onclick="onDropdownClicked(this)"><span class="pr-3">Download</span></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo 'assets/files/newsletter' . $newsletter->getTimeStamp() . '.xml'; ?>" download>XML</a>
                                <a class="dropdown-item" href="<?php echo 'assets/files/newsletter' . $newsletter->getTimeStamp() . '.json'; ?>" download>JSON</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p>Created on <?php echo $newsletter->getFullTime(); ?></p>
                <hr>
                <div class="card-columns py-2">
                    <?php
                    foreach ($newsletter->getPostList() as $id) {
                        $post = Post::selectById($id);
                        echo $post->toHTML();
                    }
                    ?>
                </div>
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