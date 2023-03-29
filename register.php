<?php

require 'functions/connectToDatabase.php';
require 'functions/auth.php';

if (isConnect()) {
    header('Location: home.php');
}

$title = "Page d'inscription";
$error = null;

if (isset($_POST["email"], $_POST['password'], $_POST['name'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT, ['cost' => 14]);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $database = connectToDatabase();
        $createUserQuery = "INSERT INTO users(prenom, email, password)VALUES(?, ?, ?)";

        try {
            $statement = $database->prepare($createUserQuery);

            $statement->execute([$name, $email, $password]);

            $user = $statement->fetch();

            session_start();

            $_SESSION['name'] = $name;
            $_SESSION['isConnected'] = 1;

            header('Location: home.php');
            die();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
    }
}

require 'layout/header.php'
?>

<h1 class="h1">Formulaire d'inscription</h1>

<?php if ($error) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif ?>

<form action="" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Prénom</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" required>
        <small id="helpId" class="text-muted">Vos informations ne seront pas partagées avec des tiers</small>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="" required>
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<div class="mt-3">Vous avez déjà un compte ? <a href="index.php">Connectez-vous</a>.</div>

<?php require 'layout/footer.php' ?>