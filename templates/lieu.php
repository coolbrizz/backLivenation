<?php
require '../vendor/autoload.php';

use App\App;

if (isset($_GET['nom'])) {
    $lieu = $_GET['nom'];
    $pdo = App::getPDO();
    $query = $pdo->prepare('SELECT * FROM venues WHERE venue = :lieu');
    $query->execute(['lieu' => $lieu]);
    $venues = $query->fetch();
} else {
    header('Location: home');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $venue = $_POST['venue'];
    $pdo = App::getPDO();
    $stmt = $pdo->prepare('DELETE FROM venues WHERE venue = :venue');
    $stmt->bindParam(':venue', $venue, PDO::PARAM_STR);
    $stmt->execute();
    header('Location: ../home');
    exit();
}
include('layout.php');

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <?php
                            $extensions = ['png', 'jpeg', 'jpg', 'gif'];
                            $imageFound = false;
                            foreach ($extensions as $ext) {
                                $imageUrl = "http://localhost:8000/photos/{$venues['slug']}.$ext";
                                // Vérifier si le fichier image existe
                                if ($imageUrl) {

                                    $imageFound = true;
                            ?>
                                    <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= $venues['slug'] ?>" style="width: 200px; height: 200px; margin-bottom: 20px">
                            <?php
                                    break;
                                }
                            }

                            if ($imageFound === false) {
                                echo '<p>Aucune image disponible</p>'; // Message si aucune image n'est trouvée 
                            }
                            ?>
                        </div>
                        <div class="col-sm-8">
                            <h3 class="card-title"><?= $venues['venue'] ?></h3>
                            <p class="card-text">Latitude : <?= $venues['address'] ?></p>
                            <p class="card-text">Longitude : <?= $venues['city'] ?></p>
                            <p class="card-text"><?= $venues['description'] ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <form action="" method="POST">
                    <input type="hidden" name="venue" value="<?= htmlspecialchars($venues['venue']) ?>">
                    <button type="submit" class="btn btn-danger mt-4">Supprimer ce lieu</button>
                </form>
            </div>
        </div>