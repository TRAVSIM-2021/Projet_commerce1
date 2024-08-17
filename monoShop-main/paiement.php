<?php

require("config/commandes.php");

if (isset($_GET['pdt'])) {
    $id = $_GET['pdt'];
    $produit = afficherUnProduit($id); 
    
    if ($produit) {
        $produit = $produit[0]; 
    } else {
        header("Location: produit.php");
        exit();
    }
} else {
    header("Location: produit.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paiement · Boutique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">MonoShop</h4>
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
        <div class="container">
            <h2>Paiement pour: <?= $produit->nom ?></h2>
            <p>Prix: <?= $produit->prix ?> $</p>

            <div id="paypal-button-container"></div>
            
            <form action="process_payment.php" method="post" style="display: none;" id="card-form">
                <div class="mb-3">
                    <label for="cardType" class="form-label">Type de carte</label>
                    <select class="form-select" id="cardType" name="cardType" required>
                        <option value="visa">Visa</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cardName" class="form-label">Nom Complet sur la Carte</label>
                    <input type="text" class="form-control" id="cardName" name="cardName" required>
                </div>

                <div class="mb-3" id="cardDetails">
                    <label for="cardNumber" class="form-label">Numéro de carte</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                </div>
                <div class="mb-3">
                    <label for="expiryDate" class="form-label">Date d'expiration</label>
                    <input type="text" class="form-control" id="expiryDate" name="expiryDate" required>
                </div>
                <div class="mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                </div>
                <div class="mb-3">
                    <label for="paypalEmail" class="form-label" style="display: none;">Email PayPal</label>
                    <input type="email" class="form-control" id="paypalEmail" name="paypalEmail" style="display: none;">
                </div>
                <button type="submit" class="btn btn-primary">Payer</button>
            </form>

        </div>
    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AeBn97n7hogUs5SP4hDTeqtw1aMVisxIzkCAizQusH6nlQm9iIqf8r729ZfnMxNcmTSktB5IbX5JyM9k"></script>
<script>
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $produit->prix ?>' 
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                alert('Transaction complétée par ' + details.payer.name.given_name + '!');
                document.getElementById('card-form').submit(); 
            });
        },
        onError: function(err) {
            console.log("erreur dans le paiement", err);
            alert("paiement échoué");
        }
    }).render('#paypal-button-container');

    document.getElementById('cardType').addEventListener('change', function() {
        var cardType = this.value;
        if (cardType === 'paypal') {
            document.getElementById('cardDetails').style.display = 'none';
            document.getElementById('paypalEmail').style.display = 'block';
        } else {
            document.getElementById('cardDetails').style.display = 'block';
            document.getElementById('paypalEmail').style.display = 'none';
        }
    });
</script>

</body>
</html>
