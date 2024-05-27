<?php

require '../vendor/autoload.php';

use App\App;

session_start();
$username = $_POST['username'] ?? NULL;
$password = $_POST['password'] ?? NULL;
$user = null;
$errors = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($username) || empty($password)) {
        $errors = 'Identifiants ou mot de passe incorrect';
    } else {
        $pdo = App::getPDO();
        $query = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute(['username' => $username]);
        $user = $query->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['auth'] = $username;
            header('Location: ../index.php');
            exit();
        } else {
            $errors = 'Identifiants ou mot de passe incorrect';
            unset($_SESSION['auth']);
        }
    }
}
include('./layout.php');
?>
<div class="titre text-center">
    <h1>Bienvenue dans le backend PHP de LiveNation</h1>
    <p>C'est ici que vous pouvez gérer votre application côté serveur.</p>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Connexion</div>
                <div class="card-body">
                    <?php if ($errors) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errors ?>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" autocomplete="username" placeholder="<?php if (!empty($username)) {
                                                                                                                                echo $username;
                                                                                                                            } else {
                                                                                                                                echo 'Nom utilisateur';
                                                                                                                            } ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe" autocomplete="current-password">
                        </div>
                        <div class="button">
                            <button type="submit" class="bouton">Me connecter</button>
                        </div>
                        <div class="href">
                            <a href=" changePassword.php" class="href">Modifier mot de passe</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>