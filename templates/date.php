<?php
require '../vendor/autoload.php';

use App\Callsql;

dd($_GET['nom']);
if (isset($_GET['nom'])) {
    $date = $_GET['nom'];
    $pdo = Callsql::getPDO();
    $query = $pdo->prepare('SELECT * FROM events WHERE title = :date');
    $query->execute(['date' => $date]);
    $utc = $query->fetch();
} else {
    header('Location: ../home');
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
// dd($events);
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $utc['year'] ?></h5>
                    <p class="card-text"><?= $utc['month'] ?></p>
                    <p class="card-text"><small class="text-muted"><?= $utc['day'] ?></small></p>
                </div>
            </div>
        </div>
    </div>
</div>