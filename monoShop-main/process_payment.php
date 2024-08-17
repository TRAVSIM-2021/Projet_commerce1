<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    header("Location: payment_confirmation.php");
    exit();
} else {
   
    header("Location: produit.php");
    exit();
}
?>
