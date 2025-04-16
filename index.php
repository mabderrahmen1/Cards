<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards - Gestionnaire de cartes de fidélité</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>My Cards</h1>

        <div id="nb-utilisateurs">
            <?php include 'nbutilisations.php'; ?>
        </div>

        <form id="cardForm">
            <h2>Ajouter/Modifier une carte</h2>
            <div class="form-group">
                <label for="cardTitle">Titre de la carte:</label>
                <input type="text" id="cardTitle" required>
            </div>
            <div class="form-group">
                <label for="cardImage">QR Code/Code Barre:</label>
                <input type="file" id="cardImage" accept="image/*" required>
            </div>
            <button type="submit" id="saveBtn">Enregistrer</button>
        </form>

        <div id="cardsList" class="cards-grid"></div>
    </div>

    <script src="app.js"></script>
</body>

</html>