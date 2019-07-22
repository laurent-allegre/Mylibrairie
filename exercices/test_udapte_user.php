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
 * On récupère le user qu'on veut modifier
 */
if(isset($_GET["user"])) {
    $user = $_GET["user"];
} else {
    die("Pas de user spécifié !");
}
/**
 * Recuperation de mon user
 */
$sqlUser = 'SELECT * FROM user WHERE id = :id';
$req = $dbh->prepare($sqlUser);
$req->bindParam(':id', $user);
$req->execute();
$result = $req->fetch();
/**
 * On récupère les données $_POST
 */
if(isset($_POST["login"])) {
    $login = $_POST["login"];
} else {
    if(isset($result["login"])) {
        $login = $result["login"];
    } else {
        $login = "";
    }
}
if(isset($_POST["password"])) {
    $password = $_POST["password"];
} else {
    if(isset($result["password"])) {
        $password = $result["password"];
    } else {
        $password = "";
    }
}
/**
 * Envoi du formulaire
 */
if(isset($_POST["envoyer"])) {
    /**
     * Enregistrement en base de données
     */
    $sql = 'UPDATE user SET
      login = :login,
      password = :password
      WHERE id = :id
    ';
    /**
     * Je prépare ma requête
     */
    $req = $dbh->prepare($sql);
    $req->bindParam(':login', $login);
    $req->bindParam(':password', $password);
    $req->bindParam(':id', $user);
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
                <input name="login" class="form-control" placeholder="" type="text" value="<?= $login ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input name="password" class="form-control" placeholder="" type="text" value="<?= $password ?>" required>
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