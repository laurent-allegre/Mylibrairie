<?php


$erreur = [];

if(isset($_POST["nom"])&& $_POST["nom"] !=""){
    $nom = htmlspecialchars($_POST["nom"]);
}else{
    $erreur[] = "le nom doit etre saisi";
}

if(isset($_POST["prenom"])&& $_POST["prenom"] !=""){
    $prenom = htmlspecialchars ($_POST["prenom"]);
}else{
    $erreur[] = "le prénom doit etre saisi";
}

if(isset($_POST["mail"])&& $_POST["mail"] !=""){
    $mail = htmlspecialchars ($_POST["mail"]);
}else{
    $erreur[] = "le mail doit etre saisi";
}

if(isset($_POST["titre"])&& $_POST["titre"] !=""){
    $titre = htmlspecialchars ($_POST["titre"]);
}else{
    $erreur[] = "le titre n'est pas requis";
}

if(isset($_POST["message"])&& $_POST["message"] !=""){
    $message = htmlspecialchars ($_POST["message"]);
}else{
    $erreur[] = "le message n'est pas renseigné";
}

if (!empty($erreur)) {
    echo '<h1>il y a des erreurs :</h1>';
    echo '<ul>';
    foreach ($erreur as $key => $value) {
        echo '<li style="color: blue;">'.$value.'</<ul>';
    }
    echo '</<ul>';
    die("");
}
//var_dump($erreur);
mail('laurent.allegre@photo-provence-passion.fr','message depuis le site',$message);

echo 'Votre nom : '.$nom. ' '.$prenom.'<br>';
echo 'votre mail: '.$mail.'<br>';
echo 'votre titre: '.$titre.'<br>';
echo 'votre message: '.$message.'<br>';

?>