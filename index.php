<?php
require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";
require_once "assets/BackEnd/Newsletter.php";
require_once "assets/BackEnd/DAONewsletter.php";

if (isset($_POST['post']) && !empty($_POST['post'])) {
    $newsletter = new Newsletter();
    $newsletter->fill(time(), $_POST['post']);
    $id = Newsletter::insert($newsletter);

    file_put_contents('assets/files/newsletter' . $newsletter->getTimeStamp() . '.xml', $newsletter->toXML());
    file_put_contents('assets/files/newsletter' . $newsletter->getTimeStamp() . '.json', $newsletter->toJSON());

    header("location: newsletter.php?id=$id");
}
$list = PostList::select();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | NLGen</title>

    <script>
        function onFilterUpdated() {
            var value = document.getElementById('search-field').value.toLowerCase();
            var items = document.querySelectorAll('.card');
            for (var item of items)
                item.classList.remove('hidden');

            var items = document.querySelectorAll('.card:not([title*="' + value + '"])');
            if (value && items)
                for (var item of items)
                    item.classList.add('hidden');
        }

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

        function onNewsletterClicked() {
            var toolbar = document.getElementsByClassName('newsletter-toolbar')[0];
            var items = document.querySelectorAll('.card');
            for (var item of items) {
                if (item.href == 'javascript:void(0)') {
                    item.href = 'post.php?id=' + item.id + '';
                    item.removeAttribute('onclick');
                    item.classList.remove('active');
                } else {
                    item.href = "javascript:void(0)";
                    item.setAttribute('onclick', 'onPostClicked(this)');
                }
            }
            if (toolbar.classList.contains('d-none')) {
                toolbar.classList.remove('d-none');
                toolbar.classList.add('d-flex');
            } else {
                toolbar.classList.add('d-none');
                toolbar.classList.remove('d-flex');
                document.getElementById('newsletter').innerHTML = '';
            }
        }

        function onPostClicked(elem) {
            var form = document.getElementById('newsletter');
            if (elem.classList.contains('active')) {
                elem.classList.remove('active');
                form.removeChild(form.querySelector('input[value="' + elem.id + '"]'));
            } else {
                elem.classList.add('active');
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'post[]';
                input.setAttribute('value', elem.id);
                form.appendChild(input);
            }
        }

        function onCreateNewsletterCliked() {
            var form = document.getElementById('newsletter');
            form.submit();
        }
    </script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column" onclick="onBodyClicked()">
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
                    <button class="btn btn-dark dropdown-toggle mr-3" onclick="onDropdownClicked(this)"><span class="pr-3">New</span></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="javascript:onNewsletterClicked()">Newsletter</a>
                        <a class="dropdown-item" href="form.php">Post</a>
                    </div>
                </div>
                <input type="text" class="form-control" id="search-field" placeholder="Search..." aria-label="name" onkeyup="onFilterUpdated()">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <span id="search-icon">&#9906;</span>
                    </span>
                </div>
            </div>
            <div class="d-none w-100 align-items-center my-3 d-none newsletter-toolbar">
                <span class="flex-grow-1 ml-3 text-muted w-100">Select the posts of the newsletter</span>
                <a href="javascript:onNewsletterClicked()" class="btn btn-outline-dark">Cancel</a>
                <a href="javascript:onCreateNewsletterCliked()" class="btn btn-dark mx-3">Create</a>
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
    <form action="index.php" method="POST" class="d-none" id="newsletter">
    </form>

</body>

</html>