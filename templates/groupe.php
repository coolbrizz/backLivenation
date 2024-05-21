<?php
require '../vendor/autoload.php';

use App\App;

//Fonction d'
if (isset($_GET['nom'])) {
    $group = $_GET['nom'];
    $pdo = App::getPDO();
    $query = $pdo->prepare('SELECT * FROM events WHERE title = :title');
    $query->execute(['title' => $group]);
    $events = $query->fetch();
} else {
    header('Location: ../home');
    exit();
}
// Fonction de suppresion du groupe de la base SQL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $pdo = App::getPDO();
    $stmt = $pdo->prepare('DELETE FROM events WHERE title = :title');
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->execute();
    header('Location: ../home');
    exit();
}
include('layout.php')
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="http://localhost:8000/photos/<?= $events['slug'] ?>.jpeg" alt="Photo" style="width: 150px; height: 150px; margin-bottom : 20px">
                            <p class="card-text"><small class="text-muted"><?= $events['excerpt'] ?></small></p>
                        </div>
                        <div class="col-sm-8">
                            <h5 class="card-title"><?= $events['title'] ?></h5>
                            <p class="card-text"><?= $events['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <form action="" method="POST">
                    <input type="hidden" name="title" value="<?= htmlspecialchars($events['title']) ?>">
                    <button type="submit" class="btn btn-danger mt-4">Supprimer ce groupe</button>
                </form>
            </div>
        </div>
    </div>