<?php


include('./layout.php');
require '../vendor/autoload.php';

use App\App;

$alert = null;
if (isset($_POST['submit'])) {

    $groupe = $_POST['title'];
    $description = $_POST['description'];
    $style = $_POST['excerpt'];
    $venue = $_POST['venue_id'];

    // Vérifier si les champs requis sont vides
    if (empty($groupe) || empty($description) || empty($style) || empty($venue)) {
        $alert = 'Veuillez remplir tous les champs du formulaire.';
    } else {
        // Connexion à la base de données
        $pdo = App::getPDO();
        // Préparer la requête SQL d'insertion avec des paramètres nommés
        $sql = "INSERT INTO events (title, description, excerpt, venue_id, slug) VALUES (:title, :description, :excerpt, :venue_id, :slug)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $groupe);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':excerpt', $style);
        $stmt->bindParam(':venue_id', $venue);
        $stmt->bindParam(':slug', $groupe);

        $stmt->execute();

        // Afficher un message de succès
        echo '<div class="alert alert-success mt-3">Votre événement a bien été ajouté.</div>';
        header('Location:../index.php');
        exit;
    }
}
?>
<div class="container mt-5">
    <h2 class="mb-4">Informations sur le groupe à ajouter</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="title">Nom du groupe</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nom du groupe">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description du groupe"></textarea>
        </div>
        <div class="form-group">
            <label for="excerpt">Style musical</label>
            <select class="form-control" id="excerpt" name="excerpt">
                <option value="">Sélectionner un style musical</option>
                <option value="Rock">Rock</option>
                <option value="Pop">Pop</option>
                <option value="Jazz">Jazz</option>
                <option value="Hiphop">Hip Hop</option>
                <option value="Electro">Électro</option>
                <option value="Metal">Métal</option>
                <option value="Reggae">Reggae</option>
                <option value="Blues">Blues</option>
            </select>
        </div>
        <div class="form-group">
            <label for="venue_id">Lieu</label>
            <select class="form-control" id="venue_id" name="venue_id">
                <option value="">Sélectionner une scène</option>
                <option value="2">Scène 1</option>
                <option value="11">Scène 2</option>
                <option value="10">Scène 3</option>
                <option value="8">Scène 4</option>
                <option value="7">Scène 5</option>
            </select>
        </div>
        <button type="submit" class="bouton mt-4" name="submit">Soumettre</button>
    </form>
    <?php if ($alert) : ?>
        <div class="alert alert-danger mt-3">Veuillez remplir tous les champs du formulaire.</div>
    <?php endif ?>
</div>