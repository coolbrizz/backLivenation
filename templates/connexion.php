<?php
require '../vendor/autoload.php';

use App\App;
use App\Auth;

$pdo = App::getPDO();
$auth = new Auth($pdo);
$errors = null;
if (!empty($_POST)) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $errors = 'Identifiants ou mot de passe incorrect';
    } else {
        $user = $auth->login($_POST['username'], $_POST['password']);
        if ($user) {
            // header('Location: home');
            exit();
        } else {
            $errors = 'Identifiants ou mot de passe incorrect';
        }
    }
}
?>

<h1>Bienvenue dans le backend PHP de LiveNation</h1>
<p>C'est ici que vous pouvez gérer votre application côté serveur.</p>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header ">Connexion</div>
                <div class="card-body">
                    <form action="<?= htmlspecialchars($router->generate('home')) ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Pseudo">
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