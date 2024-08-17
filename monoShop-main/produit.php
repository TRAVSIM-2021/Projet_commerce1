<?php

require("config/commandes.php");

$Produits = afficher();

if (isset($_GET['pdt'])) {
    if (!empty($_GET['pdt']) && is_numeric($_GET['pdt'])) {
        $id = $_GET['pdt'];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produit · Boutique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Monoshop</h4>
                    <p class="text-muted">Bienvenue dans notre boutique de chaussures !</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Connexion</h4>
                    <ul class="list-unstyled">
                        <li><a href="login.php" class="text-white">Se connecter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>MonoShop</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main>
    <div class="album py-5 bg-light">
        <div class="container" style="display: flex; justify-content: center">
            <div class="row">
                <div class="col-md-2"></div>
                <?php foreach ($Produits as $produit) {
                    if ($produit->id == $id) { ?>
                        <div class="col-md-8">
                            <div class="card shadow-sm">
                                <h3 align="center"><?= $produit->nom ?></h3>
                                <img src="<?= $produit->image ?>" style="width: 50%">
                                <div class="card-body">
                                    <p class="card-text"><?= $produit->description ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="paiement.php?pdt=<?= $produit->id ?>"><button type="button" class="btn btn-sm btn-success">Commander</button></a>
                                        </div>
                                        <small class="text" style="font-weight: bold;"><?= $produit->prix ?> $</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</main>
</body>
</html>

