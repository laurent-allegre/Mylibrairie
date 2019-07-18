<?php
session_start();
require_once('inc/my-sql-connect.php');
// Traitement de mes users ...
/**
 * Je crée un tableau d'erreurs
 */
$erreurs = []; // Ma pile d'erreurs
$user = false; // Au début false, après prendra le tableau relatif au user
/**
 * J'ai rempli mon login et mon mot de passe
 */
if(isset($_POST["email"]) && $_POST["email"] != ""
    && isset($_POST["password"]) && $_POST["password"] != "") {
    /**
     * Je vais vérifier si mon user existe
     */
    $sql = "SELECT client.id_client, client.email, client.password 
            FROM client 
            WHERE client.email = :email
            AND client.password = :password
            ";
    $req = $dbh->prepare($sql);
    $req->bindParam(':email', $_POST["email"]);
    $req->bindParam(':password', $_POST["password"]);
    $req->execute();
    $user = $req->fetch(); // Je vérifie les correspondances du mail : utilisateur trouvé
     
    if($user != false) {
         /**
          * Si remember_me est coché, je mets les éléments en cookie
          * Les cookies ont une durée de deux heures
          * Soit 7200 secondes
          * Sinon, je les mets juste en session
          */
         if(isset($_POST["remember_me"]) && $_POST["remember_me"] = "on") {
             // Création des cookies
             setcookie('id_client', $user['id_client'], time() + 7200);
         } else {
             // Création des sessions
             $_SESSION['id_client'] = $user['id_client'];
         }
         header('Location:./index.php');
    } else {
         $erreurs[] = "Mauvais login ou mauvais mot de passe.";
    }
} else {
    /**
     * J'ai envoyé mon formulaire mais mon mot de passe est vide
     */
    if(isset($_POST["password"]) && $_POST["password"] == "") {
        $erreurs[] = "Merci de saisir votre mot de passe.";
    }
    /**
     * J'ai envoyé mon formulaire mais mon email est vide
     */
    if(isset($_POST["email"]) && $_POST["email"] == "") {
        $erreurs[] = "Merci de saisir votre e-mail.";
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
require_once('inc/menu-top.php');
?>
<div class="container" style="margin-top:20px">
    <h5>Espace client</h5>
    <?php
    // Si j'ai envoyé mon formulaire
    if(isset($_POST["envoyer"])) {
        // Si je suis authentifié.e
        if(!$user) {
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
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password" id="email">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Se souvenir</label>
            <div class="col-sm-1">
                <input type="checkbox" class="form-control" name="remember_me" id="remember_me">
            </div>
        </div>
        <div class="form-group row">
            
            <div class="col-sm-1">
               <a href="inscription1.php">S'inscrire</a>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10" >
                <button type="submit" class="btn btn-primary" name="envoyer">Envoyer</button>
            </div>
        </div>
    </form>
</div>

<?php
require('inc/footer.php');
?>
</body>