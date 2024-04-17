<div class="container mt-5">
    <h2 class="mb-4">Informations sur la date à ajouter</h2>
    <form action="/" method="POST">
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
        <button type="submit" class="bouton mt-4" name="submit">Soumettre</button>
    </form>