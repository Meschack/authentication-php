<?php
require 'functions/debug.php';
require 'functions/auth.php';
require 'functions/getPosts.php';

$posts = getPosts();

$title = "Page d'accueil";

forceUserToConnect();

require 'layout/header.php';
// debug($posts)
?>

<h1>Hey, <span class="text-primary"><?= $_SESSION['name'] ?? '' ?></span></h1>

<h2 class="mt-3">Nos articles</h2>

<?php foreach ($posts as $post) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title"><a target="_blank" href="post.php?postId=<?= $post['id'] ?>"><?= $post['title'] ?></a></h4>
            <p class="card-text"><?= reduceTitle($post['content']) ?></p>

            <small><?= $post['creation_date'] ?></small>
        </div>
    </div>
<?php endforeach ?>

<?php
require 'layout/footer.php';
?>