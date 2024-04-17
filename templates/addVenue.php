<div class="container mt-5">
    <h2 class="mb-4">Informations sur le lieu à ajouter</h2>
    <form action="/" method="POST">
        <div class="form-group">
            <label for="venue">Lieu</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Lieu">
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