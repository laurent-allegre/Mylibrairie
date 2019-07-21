<?php
/**
 * Je démarre ma session
 * Car je vais avoir besoin des sessions
 */

/**
 * On inclut la connexion SQL
 */
require_once('my-sql-connect.php');
$errors = []; // Initialisation des éventuelles erreurs
/**
 * Je récupère l'id de mon client
 */
$titre = " mettre a jour la bases";
$valueSubmit = "mettre a jour";



    $sqlClient = 'SELECT * FROM client WHERE id_client = :id_client';
    $reqClient = $dbh->prepare($sqlClient);
    $reqClient->bindParam(':id_client', $idClient );
    $reqClient->execute();
    $client = $reqClient->fetch();

if(isset($_POST["nom"])) {
    $nom = $_POST["nom"];
} else {
    $nom = $client["nom"] ?? "";
    /* Equivaut à :
    if(isset($client["nom"])) {
        $nom = $client["nom"];
    } else {
        $nom = "";
    }*/
}
if(isset($_POST["prenom"])) {
    $prenom = $_POST["prenom"];
} else {
    $prenom = $client["prenom"] ?? "";
}
if(isset($_POST["email"])) {
    $email = $_POST["email"];
} else {
    $email = $client["email"] ?? "";
}
if(isset($_POST["password"])) {
    $password = $_POST["password"];
} else {
    $password = $client["password"] ?? "";
}
if(isset($_POST["adresse"])) {
    $adresse = $_POST["adresse"];
} else {
    $adresse = $client["adresse"] ?? "";
}
if(isset($_POST["ville"])) {
    $ville = $_POST["ville"];
} else {
    $ville = $client["ville"] ?? "";
}
if(isset($_POST["code_postal"])) {
    $codePostal = $_POST["code_postal"];
} else {
    $codePostal = $client["code_postal"] ?? "";
}
$valueSubmit = "creer l'utilisateur";
$titre = "Inscription";
/**
 * Quand on envoie le formulaire ...
 */
if(isset($_POST["envoyer"])) ;

$sql = 'UPDATE client SET
          nom = :nom,
          prenom = :prenom,
          email = :email,
          password = :password,
          adresse = :adresse,
          ville = :ville,
          code_postal = :code_postal
          WHERE
          id_client = :id_client
        ';

$req = $dbh->prepare($sql);
    $req->bindParam(':nom', $nom );
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':email', $email);
    $req->bindParam(':password', $password);
    $req->bindParam(':adresse', $adresse);
    $req->bindParam(':ville', $ville);
    $req->bindParam(':code_postal', $code_Postal);
    /**
     * Je binde l'id client si je suis dans une modification
     */
    if($idClient != null) {
        $req->bindParam(':id_client', $idClient);
    }
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
        $succes = "vous etes connecté !";
    }