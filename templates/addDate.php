<?php
require '../vendor/autoload.php';
include('./layout.php');

use App\App;

$pdo = App::getPDO();
$events = App::callevents();
$alert = null;
if (isset($_POST['submit'])) {

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $hour = $_POST['hour'];
    $minutes = $_POST['minutes'];
    $group = $_POST['group'];

    // Vérifier si les champs requis sont vides
    if (empty($day) || empty($month) || empty($year) || empty($hour) || empty($minutes)) {
        $alert = 'Veuillez remplir tous les champs du formulaire.';
    } else {
        // Connexion à la base de données
        $pdo = App::getPDO();
        // Préparer la requête SQL d'insertion avec des paramètres nommés
        $sql = "INSERT INTO utc_start_date_details (day , month, year,hour, minutes,event_id) VALUES (:day, :month, :year, :hour, :minutes, :eventId)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':day', $day);
        $stmt->bindParam(':month', $month);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':hour', $hour);
        $stmt->bindParam(':minutes', $minutes);
        $stmt->bindParam(':eventId', $group);

        $stmt->execute();

        header('Location:../index.php');
        exit;
    }
}
?>
<div class="container mt-5">
    <h2 class="mb-4">Informations sur la date à ajouter</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="day">Jour</label>
            <input type="text" class="form-control" id="day" name="day" placeholder="Jour">
        </div>
        <div class="form-group">
            <label for="month">Mois</label>
            <input class="form-control" id="month" name="month" rows="3" placeholder="Mois">
        </div>
        <div class="form-group">
            <label for="year">Année</label>
            <input class="form-control" id="year" name="year" rows="3" placeholder="Année">
        </div>
        <div class="form-group">
            <label for="hour">Heure</label>
            <input class="form-control" id="hour" name="hour" rows="3" placeholder="heure">
            <label for="minutes">Minutes</label>
            <input class="form-control" id="minutes" name="minutes" rows="3" placeholder="minutes">
        </div>

        <div class="form-group">
            <label for="group">Pour quelle groupe ?</label>
            <select class="form-control" id="group" name="group">
                <option value="">Sélectionner un groupe de musique</option>
                <?php foreach ($events as $event) : ?>
                    <option value="<?= $event['id'] ?>"><?= $event['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="bouton mt-4" name="submit">Soumettre</button>
    </form>
    <?php if ($alert) : ?>
        <div class="alert alert-danger mt-3">Veuillez remplir tous les champs du formulaire.</div>
    <?php endif ?>