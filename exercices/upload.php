<?php

if (isset($_POST["submit"])&&isset($_FILES['picture'])){
    var_dump($_FILES);
    $uploadDir = dirname (__FILE__) . "\uploads\\";
    $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

//je verifie si le dossier existe sinon je le créer
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        } 


    if(@move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)){
        echo" le fichier a ete telecharger. ";
    }else{
        echo"il y a eu un probleme <br>";
        print_r($_FILES['picture']['error']);
    }
}
    echo __FILE__;
?>
<h1>Upload de fichier</h1>

<form action=""method="post" enctype="multipart/form-data" >
<p>image:
    <input type="file" name="picture">
    <input type="submit" value="Send" name="submit">
</p>
</form>