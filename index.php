<?php
require 'functions/connectToDatabase.php';
require 'functions/auth.php';

if (isConnect()) {
    header('Location: home.php');
}

$title = "Page de connexion";

$error = null;

if (isset($_POST["email"], $_POST['password'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $database = connectToDatabase();
        $connectUserQuery = "SELECT * FROM users WHERE email = ?";

        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $statement = $database->prepare($connectUserQuery);

            $statement->execute([$email]);

            $user = $statement->fetch();

            if (!empty($user) && password_verify($password, $user['password'])) {
                $_SESSION['name'] = $user['prenom'];
                $_SESSION['isConnected'] = 1;

                header('Location: home.php');
                exit();
            } else {
                $error = "Identifiants de connexion incorrects";
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
    }
}

require 'layout/header.php'
?>

<h1 class="h1">Formulaire de connexion</h1>

<?php if ($error) : ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif ?>

<form action="" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com" value="<?= $_POST["email"] ?? null ?>" required>
        <small id="emailHelpId" class="form-text text-muted">Vos informations ne seront pas partagés avec des tiers</small>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="" required>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<div class="mt-3">Vous n'avez pas encore de compte ? <a href="register.php">Inscrivez-vous</a>.</div>

<?php require 'layout/footer.php' ?>