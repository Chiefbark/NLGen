<?php

require_once "assets/BackEnd/DBConn.php";
require_once "assets/BackEnd/Post.php";
require_once "assets/BackEnd/DAOPost.php";
echo phpinfo();
$post = new Post();

if (isset($_POST) && !empty($_POST)) {
        $post->fill($_POST['title'], $_POST['author'], $_FILES['photo'], $_POST['content']);
        Post::insert($post);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/form.js"></script>

    <title>New Post | NLGen</title>
    <script>
        window.addEventListener("load", function () {
            inputListener();
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    removePlugins: ['ImageUpload']
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    <link href="assets/css/form.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">New Post</h2>
                </div>
                <div class="card-body">


                    <form method="POST" action="form.php">
                    <input class="" type="text" name="id" style="display: none">
                        <div class="form-row">
                            <div class="name">Title</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="title">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Author</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="author">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Upload photo</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="photo" id="file">
                                    <label class="label--file" for="file">Choose file</label>
                                    <span class="input-file__info">No file chosen</span>
                                </div>
                                <div class="label--desc">Upload your photo post</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <textarea name="content" style="display: none;"></textarea>
                            <div class="name">Message</div>
                            <div class="value">
                                <div id="editor">
                                    <p>This is some sample content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn--radius-2 btn--blue-2" type="submit">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>