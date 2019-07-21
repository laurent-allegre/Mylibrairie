<?php
/**
 * Je démarre ma session
 * Car je vais avoir besoin des sessions
 */
session_start();
/**
 * On inclut la connexion SQL
 */

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
   require_once("modif.php");
}else{
    require_once("insert.php");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>$titre</title>

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