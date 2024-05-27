<?php
require '../vendor/autoload.php';

use App\App;

session_start();
$username = "admin";
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['oldpassword'] ?? null;
    $newPassword = $_POST['newpassword'] ?? null;
    $confirmNewPassword = $_POST['confirmnewpassword'] ?? null;

    if (empty($oldPassword) || empty($newPassword) || empty($confirmNewPassword)) {
        $error = "Veuillez renseigner tous les champs.";
    } else {
        $pdo = App::getPDO();
        $query = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute(['username' => $username]);
        $user = $query->fetch();

        if ($user && password_verify($oldPassword, $user['password']) || $oldPassword ===  $user['password']) {
            if (strlen($oldPassword) < 8) {
                $errors = "Le mot de passe doit comporter au moins 8 caractères.";

                if ($newPassword === $confirmNewPassword) {
                    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                    $update = $pdo->prepare('UPDATE users SET password = :newPassword WHERE username = :username');
                    $update->execute(['newPassword' => $newPasswordHash, 'username' => $username]);
                    header('Location: ../index.php');
                    exit();
                }
            } else {
                $error = "Les nouveaux mots de passe ne correspondent pas.";
            }
        } else {
            $error = "L'ancien mot de passe est incorrect.";
        }
    }
}
include('./layout.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du mot de passe</title>
</head>

<body>
    <div class="titre text-center">
        <h1>Modification du mot de passe</h1>
        <p>Vous pouvez maintenant renforcer la sécurité du back en changeant votre mot de passe.</p>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Modifier votre mot de passe</div>
                    <div class="card-body">
                        <?php if ($error) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur :</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username) ?>" autocomplete="username" readonly>
                            </div>
                            <div class="form-group">
                                <label for="oldpassword">Votre ancien mot de passe :</label>
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Ancien mot de passe" autocomplete="current-password" required>
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Votre nouveau mot de passe :</label>
                                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Nouveau mot de passe" autocomplete="new-password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmnewpassword">Confirmer votre nouveau mot de passe :</label>
                                <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirmer nouveau mot de passe" autocomplete="new-password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>