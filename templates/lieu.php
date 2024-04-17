<?php
require '../vendor/autoload.php';

use App\Callsql;

if (isset($_GET['nom'])) {
    $lieu = $_GET['nom'];
    $pdo = Callsql::getPDO();
    $query = $pdo->prepare('SELECT * FROM venues WHERE venue = :lieu');
    $query->execute(['lieu' => $lieu]);
    $venues = $query->fetch();
} else {
    header('Location: home');
}
// dd($venues);
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
                                $imageUrl = "photos/{$venues['slug']}.$ext";
                                // Vérifier si le fichier image existe
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $imageUrl)) {
                                    $imageFound = true;
                            ?>
                                    <img src="<?= htmlspecialchars($imageUrl) ?>" alt="Photo" style="width: 200px; height: 200px; margin-bottom: 20px">
                            <?php
                                    break;
                                }
                            }

                            if (!$imageFound) {
                                echo '<p>Aucune image disponible</p>'; // Message si aucune image n'est trouvée avec les extensions spécifiées
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
        </div>