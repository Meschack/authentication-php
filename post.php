<?php

require 'functions/getPosts.php';
require 'functions/debug.php';

$id = $_GET['postId'];

$post = getSinglePost($id);

// debug($post);
$title = $post['title'];

require 'layout/header.php'
?>

<h1><?= $post['title'] ?></h1>
<small>Publié le <em><?= $post['creation_date'] ?></em></small>

<p>
    <?= $post['content'] ?>
</p>