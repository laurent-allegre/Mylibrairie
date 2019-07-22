<?php
$login = "root";
$password = "";
$id =$_GET['id'];
try{
    $base = "mysql:host=localhost; dbname=mytest";
    $dbh = new PDO($base, $login , $password,array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'));

} catch(PDOExecption $e){
    echo "Erreur :".$e->getMessage()."<br>";
    die();
  }


/**
 * On récupère les données $_POST
 */
$login            = $_POST["login"] ?? "";
/**
 * Equivaut à :
 *
 * $login = isset($_POST["login"]) ? $_POST["login"] : "";
 *
 * ou à :
 *
 * if(isset($_POST["login"])) {
 *    $login = $_POST["login"];
 * } else {
 *    $login = "";
 * }
 */
$password         = $_POST["password"] ?? "";
/**
 * Envoi du formulaire
 */
if(isset($_POST["envoyer"])) {
    /*
     * Transfert de la photo
     */
    if (isset($_FILES["photo"]) && ($_FILES["photo"]["name"] != "")) {
        if ($_FILES["photo"]["type"] == "image/jpeg") {
            $uploaddir = dirname(__FILE__) . "/uploads/";
            $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
            $photo = 'uploads/' . $_FILES['photo']['name'];
            /**
             * Upload du fichier
             * Si il a été uploadé, on affiche un message de succès
             * Sinon, on affiche un debug
             */
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                print_r($_FILES['photo']['error']);
                die("Problème lors du téléchargement de l'image.");
            }
        } else {
            die("Format de l'image non valide.");
        }
    } else {
        $photo = null;
    }
    /**
     * Enregistrement en base de données
     */
    $sql = 'INSERT INTO user (
      login,
      password,
      photo
    )
    VALUES(
      :login,
      :password,
      :photo
    )';
    /**
     * Je prépare ma requête
     */
    $req = $dbh->prepare($sql);
    $req->bindParam(':login', $login);
    $req->bindParam(':password', $password);
    $req->bindParam(':photo', $photo);
    $result = $req->execute();
    if (!$result) {
        var_dump($req->errorInfo());
    } else {
        echo "Tout s'est bien passé !";
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>

<!-- Page Content -->
<div class="container" style="margin-top:20px">

    <h5>User</h5>


    <form method="POST" action="" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="nom" class="col-sm-2 col-form-label">Login</label>
            <div class="col-sm-10">
                <input name="login" class="form-control" placeholder="" type="text" value="" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input name="password" class="form-control" placeholder="" type="text" value="" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="titre" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10 input-group date">
                <input name="photo" class="form-control-file" placeholder="" type="file">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="envoyer" class="btn btn-primary btn-block">Envoyer</button>
        </div>

    </form>

</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.js"></script>
</body>

</html>
