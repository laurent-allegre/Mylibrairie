<?php
session_start();
require_once('inc/users.php');
// Traitement de mes users ...
/**
 * Je crée un tableau d'erreurs
 */
$erreurs = []; // Ma pile d'erreurs
$isAuth = false; // Utilisateur authentifié ou non ? Au début, non.

/**
 * J'ai rempli mon login et mon mot de passe
 */
if(isset($_POST["email"]) && $_POST["email"] != ""
    && isset($_POST["password"]) && $_POST["password"] != "") {
    /**
     * Je parcours ma liste de users
     */
    foreach($users as $user) {
        // Je vérifie les correspondances du mail : utilisateur trouvé
        if($_POST['email'] == $user['email']) {
            if ($_POST['password'] == $user['password']) {
                $isAuth = true; // Utilisateur authentifié

                    if(isset($_POST['remember']) && $_POST['remember'] == 'on'){
                        setcookie('email' , $user["email"], time()+3600);
                        setcookie('prenom' , $user["prenom"], time()+3600);
                    }else{
                        $_SESSION["email"] = $user["email"];
                        $_SESSION["prenom"] = $user["prenom"];
                    }
                  
                header('location:index.php');
                continue; // arrête d'itérer le foreach
            }
        }
    }
    if($isAuth == false) {
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