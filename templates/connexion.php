<?php

require '../vendor/autoload.php';

use App\App;

session_start();
$username = $_POST['username'] ?? NULL;
$password = $_POST['password'] ?? NULL;
$errors = null;

if (!empty($_POST)) {
    $pdo = App::getPDO();
    $query = $pdo->prepare('SELECT * FROM users WHERE username = :username ');
    $query->execute(['username' => $username]);
    $user = $query->fetch();



    if (empty($_POST['username']) || empty($_POST['password'])) {
        $errors = 'Identifiants ou mot de passe incorrect';
    } else {
        if ($user && $_POST['username'] === $user['username'] && $_POST['password'] === $user['password']) {
            $_SESSION['auth'] = [$username, $password];
            header('Location:../index.php');
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
                            <input type="text" class="form-control" name="username" placeholder="<?php if (!empty($username)) {
                                                                                                        echo $username;
                                                                                                    } else {
                                                                                                        echo 'nom utilisateur';
                                                                                                    } ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary">Me connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>