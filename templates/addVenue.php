<?php
include('./layout.php');
require '../vendor/autoload.php';

use App\App;

$alert = null;
if (isset($_POST['submit'])) {

    $lieu = $_POST['lieu'];
    $description = $_POST['description'];
    $latitude = $_POST['address'];
    $longitude = $_POST['city'];

    // Vérifier si les champs requis sont vides
    if (empty($lieu) || empty($description) || empty($latitude) || empty($longitude)) {
        $alert = 'Veuillez remplir tous les champs du formulaire.';
    } else {
        // Connexion à la base de données
        $pdo = App::getPDO();
        // Préparer la requête SQL d'insertion avec des paramètres nommés
        $sql = "INSERT INTO venues (venue, description, address, city, slug) VALUES (:venue, :description, :address, :city, :slug)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':venue', $lieu);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':address', $latitude);
        $stmt->bindParam(':city', $longitude);
        $stmt->bindParam(':slug', $lieu);

        $stmt->execute();

        header('Location:../index.php');
        exit;
    }
}
?>
<div class="container mt-5">
    <h2 class="mb-4">Informations sur le lieu à ajouter</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="venue">Lieu</label>
            <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description du groupe"></textarea>
        </div>
        <div class="form-group">
            <label for="address">Latitude du lieu</label>
            <input class="form-control" id="address" name="address" rows="3" placeholder="Latitude du lieu">
        </div>
        <div class="form-group">
            <label for="city">Longitude du lieu</label>
            <input class="form-control" id="city" name="city" rows="3" placeholder="Longitude du lieu">
            <button type="submit" class="bouton mt-4" name="submit">Soumettre</button>
    </form>
    <?php if ($alert) : ?>
        <div class="alert alert-danger mt-3">Veuillez remplir tous les champs du formulaire.</div>
    <?php endif ?>