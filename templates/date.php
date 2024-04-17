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
    header('Location: home');
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