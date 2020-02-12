<?php
require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";

$post = new Post();

if (isset($_POST) && !empty($_POST)) {
    $post->fill($_POST['title'], $_POST['author'], $_POST['content'], time());
    $id = Post::insert($post, $_FILES['photo']);

    $list = PostList::select();
    file_put_contents('assets/files/posts.xml', $list->toXML());
    file_put_contents('assets/files/posts.json', $list->toJSON());

    header("location: post.php?id=$id");
}
if (!$post)
    header('location: index.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Post | NLGen</title>

    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script>
        window.addEventListener("load", function() {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    removePlugins: ['ImageUpload']
                })
                .catch(error => {
                    console.error(error);
                });
        });

        function loadContent() {
            document.getElementById('content').value = document.querySelector('.ck-content').innerHTML;
        }

        function updateImage() {
            document.querySelector('label.custom-file-label').innerHTML = document.getElementById('photo').files.item(0).name;
        }
    </script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column">
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
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="loadContent()">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author" id="author" required autocomplete="off">
            </div>
            <div class="custom-file mt-3">
                <input type="file" class="custom-file-input" name="photo" id="photo" required autocomplete="off" onchange="updateImage()">
                <label class="custom-file-label" for="photo">Choose file</label>
            </div>
            <div class="form-group mt-4">
                <textarea id="content" name="content" id="content" style="display: none;" autocomplete="off"></textarea>
                <div class="mb-2">Content</div>
                <div class="value">
                    <div id="editor">
                        <p>Write your content here.</p>
                    </div>
                </div>
            </div>
            <input type="submit" class="col-12 btn btn-dark py-3">
        </form>
    </div>

    <footer class="py-5 bg-dark mt-4">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; NLGen 2020</p>
        </div>
    </footer>

</body>

</html>