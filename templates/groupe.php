<?php
require '../vendor/autoload.php';

use App\Callsql;

if (isset($_GET['nom'])) {
    $group = $_GET['nom'];
    $pdo = Callsql::getPDO();
    $query = $pdo->prepare('SELECT * FROM events WHERE title = :group');
    $query->execute(['group' => $group]);
    $events = $query->fetch();
} else {
    header('Location: home');
    exit();
}
// dd($events);
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
        </div>
    </div>