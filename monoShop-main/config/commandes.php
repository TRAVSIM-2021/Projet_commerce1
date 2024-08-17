<?php

function ajouterUser($nom, $prenom, $email, $motdepasse)
{
    require("connexion.php");

    $req = $access->prepare("INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)");

    $req->execute(array($nom, $prenom, $email, $motdepasse));

    $req->closeCursor();

    return true;
}

function getUsers($email, $password)
{
    require("connexion.php");

    $req = $access->prepare("SELECT * FROM utilisateurs WHERE email = ? AND motdepasse = ?");
    $req->execute(array($email, $password));

    if ($req->rowCount() == 1) {
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } else {
        return false;
    }
}

function modifier($image, $nom, $prix, $desc, $id)
{
    require("connexion.php");

    $req = $access->prepare("UPDATE produits SET `image` = ?, nom = ?, prix = ?, description = ? WHERE id = ?");

    $req->execute(array($image, $nom, $prix, $desc, $id));

    $req->closeCursor();
}

function afficherUnProduit($id)
{
    require("connexion.php");

    $req = $access->prepare("SELECT * FROM produits WHERE id = ?");
    $req->execute(array($id));

    $data = $req->fetchAll(PDO::FETCH_OBJ);

    $req->closeCursor();

    return $data;
}

function ajouter($image, $nom, $prix, $desc)
{
    require("connexion.php");

    $req = $access->prepare("INSERT INTO produits (image, nom, prix, description) VALUES (?, ?, ?, ?)");

    $req->execute(array($image, $nom, $prix, $desc));

    $req->closeCursor();
}

function afficher()
{
    require("connexion.php");

    $req = $access->prepare("SELECT * FROM produits ORDER BY id DESC");
    $req->execute();

    $data = $req->fetchAll(PDO::FETCH_OBJ);

    $req->closeCursor();

    return $data;
}

function supprimer($id)
{
    require("connexion.php");

    $req = $access->prepare("DELETE FROM produits WHERE id = ?");
    $req->execute(array($id));

    $req->closeCursor();
}

function getAdmin($email, $password)
{
    require("connexion.php");

    $req = $access->prepare("SELECT * FROM admin WHERE email = ? AND motdepasse = ?");
    $req->execute(array($email, $password));

    if ($req->rowCount() == 1) {
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } else {
        return false;
    }
}

?>

