<?php
session_start();
require_once('inc/my-sql-connect.php');
$sql = "SELECT prenom, email, password FROM client";
$req = $dbh->prepare($sql);
$req->execute();
$users = $req->fetchAll();

// Traitement de mes users ...
/**
 * Je crée un tableau d'erreurs
 */
$erreurs = []; // Ma pile d'erreurs
$isAuth = false; // Utilisateur authentifié ou non ? Au début, non.

/**
 * J'ai rempli mon login et mon mot de passe
 */

// INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse`, `code postal`, `villes`, `email`, `password`) VALUES (NULL, 'poche', 'jules', '78 allée de la résistance', '84210', 'monteux', 'lolo@com', '123456');
isset($_POST["nom"]) ?   $nom=isset($_POST["nom"]) : $nom = '';
isset($_POST["prenom"]) ?  $prenom=isset($_POST["prenom"]) : $prenom = '';
isset($_POST["adresse"]) ?  $adresse=isset($_POST["adresse"]) : $adresse = '';
isset($_POST["code-postal"]) ?  $code-postal=isset($_POST["code-postal"]) : $code-postal = '';
isset($_POST["ville"]) ?  $ville=isset($_POST["ville"]) : $ville = '';
isset($_POST["email"]) ?  $email=isset($_POST["email"]) : $email = '';
isset($_POST["password"]) ?  $password=isset($_POST["password"]) : $password = '';

$sql = "
INSERT INTO `client` 
(`id_client`, `nom`, `prenom`, `adresse`, `code postal`, `villes`, `email`, `password`)

VALUES (
    NULL
    , :nom
    , :prenom
    , :adresse
    , :code-postal
    , :ville
    , :email
    , :password
);";


$req = $dbh->prepare($sql);
$req->bindValue(':nom', intval(trim($nb)), PDO::PARAM_STR);
$req->bindValue(':prenom', intval(trim($nb)), PDO::PARAM_STR);
$req->bindValue(':adresse', intval(trim($nb)), PDO::PARAM_STR);
$req->bindValue(':code-postal', intval(trim($nb)), PDO::PARAM_STR);
$req->bindValue(':ville', intval(trim($nb)), PDO::PARAM_STR);
$req->bindValue(':email', intval(trim($nb)), PDO::PARAM_STR);
$req->bindValue(':password', intval(trim($nb)), PDO::PARAM_STR);
$req->execute();



if(isset($_POST["email"]) ){

}
    /**
     * Je parcours ma liste de users
     */
    
        

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
require_once('inc/menu-top.php');

?>
<div class="container" style="margin-top:20px">
    <h5>Espace client</h5>
    <?php
    // Si j'ai envoyé mon formulaire
    if(isset($_POST["envoyer"])) {
        // Si je suis authentifié.e
        if($isAuth) {
            echo "<h5>Vous êtes authentifié.e :) </h5>";

        } else {
            echo '<div class="alert alert-danger fade show">';
            echo '<ul>';
            foreach($erreurs as $erreur) {
                echo '<li>'.$erreur.'</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
    ?>

    <form action="" method="POST">

        <div class="form-group row">
            <label for="nom" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nom" id="nom">
            </div>
        </div>
        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">prenom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="prenom" id="prenom">
            </div>
        <div class="form-group row">
            <label for="adresse" class="col-sm-2 col-form-label">adresse</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="adresse" id="adresse">
            </div>
        <div class="form-group row">
            <label for="code-postal" class="col-sm-2 col-form-label">Code postal</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="c-postal" id="c-postal">
            </div>
        <div class="form-group row">
            <label for="Ville" class="col-sm-2 col-form-label">ville</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ville" id="ville">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Mot de passe1</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password" id="password">
            </div>
        </div>
        <div class="form-group row">
            <label for="password2" class="col-sm-2 col-form-label">Mot de passe 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password2" id="password2">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10" >
                <button type="submit" class="btn btn-primary" name="envoyer">Envoyer</button>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10" >
                <input type="checkbox" class="btn btn-primary" name="remember">Remember me</input>
            </div>
        </div>
    </form>
</div>

<?php
require('inc/footer.php');
?>
</body>