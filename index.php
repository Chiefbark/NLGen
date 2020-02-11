<?php
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

        function toggleDropdown(elem) {
            if (elem.nextElementSibling.style.display != 'block')
                elem.nextElementSibling.style.display = 'block';
            else
                elem.nextElementSibling.style.display = '';
        }

        function resetDropdowns() {
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

<body class="d-flex flex-column" onclick="resetDropdowns()">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">NLGen</a>
        </div>
    </nav>

    <div class="container flex-grow">
        <div class="row">
            <h3 class="col-md-7">Browse over all our posts</h3>
            <div class="input-group mb-3 col-md-5">
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle mr-3" onclick="toggleDropdown(this)"><span class="pr-3">Download</span></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="assets/files/posts.xml" download="posts.xml">xml</a>
                        <a class="dropdown-item" href="assets/files/posts.json" download="posts.json">json</a>
                    </div>
                </div>
                <a href="form.php" class="btn btn-dark mr-3">&#x002B</a>
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