<?php
session_start();
require './vendor/autoload.php';

use App\Callsql;

if (!isset($_SESSION['auth'])) {
    header('Location:templates/connexion.php');
    exit();
}
try {

    $pdo = Callsql::getPDO();
    $events = Callsql::callevents();
    $venues = Callsql::callvenues();
    $dates = Callsql::calldate();
    $programmation = Callsql::callProgrammation();
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
?>
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
    <link href="./templates/style.css" rel="stylesheet">
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
<div class="container">
    <h1 class="text-center mb-5">Retrouver toutes vos infos ici</h1>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card" style="min-height: 450px">
                <div class="title card-header">Groupe de musique</div>
                <div class="card-body">
                    <ul class="custom-list">
                        <?php foreach ($events as $event) : ?>
                            <li><a style="font-weight: bold;" href="./templates/groupe.php?nom=<?= urlencode($event['title']) ?>"><?= $event['title'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="text-center">

                <button class="bouton mt-3"><a href='/templates/addGroup.php'>Ajouter un groupe</a></button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="min-height: 450px">
                <div class="title card-header">Lieux</div>
                <div class="card-body">
                    <ul class="custom-list">
                        <?php foreach ($venues as $venue) : ?>
                            <li><a href="./templates/lieu.php?nom=<?= urlencode($venue['venue']) ?>"><?= $venue['venue'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                <button class="bouton mt-3"><a href='/templates/addVenue.php'>Ajouter un lieu</a></button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="min-height: 450px">
                <div class="title card-header">Dates</div>
                <div class="card-body">
                    <ul class="custom-list">
                        <?php
                        $displayedDates = [];
                        foreach ($dates as $date) {
                            $day = $date['day'];
                            $month = $date['month'];
                            $year = $date['year'];
                            $formattedDate = "$day-$month-$year";
                            // Vérifier si la date a déjà été affichée
                            if (!in_array($formattedDate, $displayedDates)) {
                                $displayedDates[] = $formattedDate;
                        ?>
                                <li><a><?= $formattedDate ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                <button class="bouton mt-3"><a href='/templates/addDate.php'> Ajouter une date</a></button>
            </div>
        </div>
    </div>

    <div class="programme">
        <h1 class="text-center mt-5">Programmation Complète</h1>
        <div class="row">
            <?php foreach ($programmation as $programmations) : ?>
                <div class="col-md-3">
                    <div class="card mt-4">
                        <div class="title card-header"><a style="color: black" href="./templates/groupe.php?nom=<?= urlencode($programmations['title']) ?>"><?= $programmations['title'] ?></a></div>
                        <div class="card-body text-center">
                            <img src="http://localhost:8000/photos/<?= $programmations['slug'] ?>.jpeg" alt="Photo" style="width: 200px; height: 200px; margin-bottom : 20px">
                            <p>Lieux : <?= $programmations['venue'] ?></p>
                            <p>Date : <?= $programmations['day'] . '/' . $programmations['month'] . '/' . $programmations['year'] ?></p>
                            <p>Heure : <?= $programmations['hour'] . ':' . $programmations['minutes'] ?>0</p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>