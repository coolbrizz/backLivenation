<?php

if (isset($_POST['destroy_session'])) {
    // Détruire une variable de session spécifique
    unset($_SESSION['auth']);
    header('Location:templates/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back livenation</title>
    <meta name="description" content="">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Backend LiveNation</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="..\index.php">Accueil <span class="sr-only">home</span></a>
                </li>
            </ul>
        </div>
        <?php if (!empty($_SESSION['auth'])) : ?>
            <form action="" method="post">
                <button type="submit" name="destroy_session" class="bouton btn-danger">Se déconnecter</button>
            </form>
        <?php endif; ?>
    </nav>

    <div class="container mt-5">

    </div>

</body>

</html>