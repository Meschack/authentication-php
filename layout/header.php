<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./style/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>

    <header class="bg-secondary px-3">
        <nav class="nav justify-content-end  ">
            <?php if (!isset($_SESSION['isConnected'])) : ?>
                <a class="nav-link active text-white" href="register.php" aria-current="page">S'inscrire</a>
                <a class="nav-link text-white" href="index.php">Se connecter</a>
            <?php else : ?>
                <a class="nav-link text-white" href="logout.php">Déconnexion</a>
            <?php endif ?>
        </nav>
    </header>

    <div class="container mt-3">