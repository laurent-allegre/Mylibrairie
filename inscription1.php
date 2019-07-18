<?php
/**
 * Je démarre ma session
 * Car je vais avoir besoin des sessions
 */
session_start();
/**
 * On inclut la connexion SQL
 */
require_once('inc/my-sql-connect.php');
$errors = []; // Initialisation des éventuelles erreurs
/**
 * Je récupère l'id de mon client
 */
$idClient = null;
/**
 * Si je suis connecté.e en session ...
 */
if(isset($_SESSION["id_client"])) {
    $idClient = $_SESSION["id_client"];
}
/**
 * Si je suis connecté.e en cookie
 */
else if(isset($_COOKIE["id_client"])) {
    $idClient = $_COOKIE["id_client"];
}
/**
 * Je récupère les infos de mon client s'il est connecté
 */
if($idClient != null) {
    $sqlClient = 'SELECT * FROM client WHERE id_client = :id_client';
    $reqClient = $dbh->prepare($sqlClient);
    $reqClient->bindParam(':id_client', $idClient );
    $reqClient->execute();
    $client = $reqClient->fetch();
}
/**
 * On récupère les infos envoyées
 * L'envoi des données en POST est prioritaire
 * Sinon on va chercher les données dans la base client
 * Sinon c'est vide
 */
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
$valueSubmit = is_null($idClient) ? "Créer l'utilisateur" : "Modifier vos données";
$titre = is_null($idClient) ? "Inscription" : "Votre compte utilisateur";
/**
 * Quand on envoie le formulaire ...
 */
if(isset($_POST["envoyer"])) {
    /**
     * Requete pour AJOUTER
     * Elle s'effectue quand il n'y a ni COOKIE ni SESSION
     */
    if($idClient == null) {
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
    } else {
        /**
         * Requête pour MODIFIER l'utilisateur
         * S'effectue quand il y a SESSION OU COOKIE
         */
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
    }
    /**
     * Je prépare ma requête (d'ajout ou de modification)
     */
    $req = $dbh->prepare($sql);
    $req->bindParam(':nom', $nom );
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':email', $email);
    $req->bindParam(':password', $password);
    $req->bindParam(':adresse', $adresse);
    $req->bindParam(':ville', $ville);
    $req->bindParam(':code_postal', $codePostal);
    /**
     * Je binde l'id client si je suis dans une modification
     */
    if($idClient != null) {
        $req->bindParam(':id_client', $idClient);
    }
    /**
     * Execution de la requête
     */
    $result = $req->execute();
    /**
     * Mise en mémoire des erreurs rencontrées
     */
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
    /**
     * Configuration des messages de succès
     */
    if($idClient == null) {
        $succes = "Vous avez bien été inscrit.e !";
    } else {
        $succes = "Les modifications ont été effectuées !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ma super boutique</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<?php
require_once("inc/menu-top.php");
?>

<!-- Page Content -->
<div class="container" style="margin-top:20px">

    <h5><?= $titre ?></h5>

    <?php
    if(isset($result)) {
        if($result) {
            echo '<div class="alert alert-success fade show">';
            echo "<p>".$succes."</p>";
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger fade show">';
            echo "<p>Echec de l'inscription !</p>";
            foreach($errors as $data) {
                echo $data."<br>";
            }
            echo '</div>';
        }
    }
    ?>

    <form method="POST" action="">
        <div class="form-group row">
            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input name="nom" class="form-control" placeholder="" type="text" value="<?= $nom ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Prenom</label>
            <div class="col-sm-10">
                <input name="prenom" class="form-control" placeholder="" type="text" value="<?= $prenom ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input name="email" class="form-control" placeholder="" type="email" value="<?= $email ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
            <div class="col-sm-10">
                <input name="password" class="form-control" placeholder="" type="password" value="<?= $password ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="adresse" class="col-sm-2 col-form-label">Adresse</label>
            <div class="col-sm-10">
                <input name="adresse" class="form-control" placeholder="" type="text" value="<?= $adresse ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="code_postal" class="col-sm-2 col-form-label">Code postal</label>
            <div class="col-sm-10">
                <input name="code_postal" class="form-control" placeholder="" type="text" value="<?= $codePostal ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="ville" class="col-sm-2 col-form-label">Ville</label>
            <div class="col-sm-10">
                <input name="ville" class="form-control" placeholder="" type="text" value="<?= $ville ?>" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="envoyer" class="btn btn-primary btn-block"><?= $valueSubmit ?></button>
        </div>

    </form>

</div>
<!-- /.container -->

<?php
require('inc/footer.php');
?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>