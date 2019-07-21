<?php
/**
 * Je démarre ma session
 * Car je vais avoir besoin des sessions
 */
session_start();
/**
 * On inclut la connexion SQL
 */
require_once('my-sql-connect.php');

$nom = $_POST["nom"] ?? "";
$prenom = $_POST["prenom"] ?? "";
$email = $_POST["email"] ?? "";
$adresse = $_POST["adresse"] ?? "";
$ville = $_POST["ville"] ?? "";
$code_postal = $_POST["code_postal"] ?? "";

$valueSubmit = "creer l'utilisateur";
$titre = "Inscription";


if(isset($_POST["envoyer"])) {

    $sql = 'INSERT INTO client (
        nom,
        prenom,
        email,
        password,
        adresse,
        ville,
        code_postal
    ) VALUES (
        :nom,
        :prenom,
        :email,
        :password,
        :adresse,
        :ville,
        :code_postal
    )';
$req = $dbh->prepare($sql);
$req->bindParam(':nom', $nom );
$req->bindParam(':prenom', $prenom);
$req->bindParam(':email', $email);
$req->bindParam(':password', $password);
$req->bindParam(':adresse', $adresse);
$req->bindParam(':ville', $ville);
$req->bindParam(':code_postal', $codePostal);
$result = $req->execute();

if(!$result) {
    $error = $req->errorInfo();

    switch($error[0]) {
        case "22001":
            $errors[] = "Attention, vos champs sont trop longs !";
            break;
        case "23000":
            $errors[] = "Cette adresse e-mail existe déjà !";
            break;
    }
}
    $succes = "vous avez été inscrit !";
}


