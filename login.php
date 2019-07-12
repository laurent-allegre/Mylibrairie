      <?php
        require_once('inc/menu-top.php');
        require_once('inc/users.php');

        $erreurs = [];
        $isAuth = false;

//je remplis les champs du formulaire

        if(isset($_POST["email"])&& $_POST["email"] !=""&& isset($_POST["password"]) 
        && $_POST["password"] != "") {
         
          // je parcours les utilisateurs         
          foreach ($users as $key => $user) {
            if( $_POST['email'] == $user['email']){
              

              if($_POST['password'] == $user['password']){
                
                $isAuth = true;
                continue;
              } 
            }
          }

          if($isAuth == false) {
            $erreurs[] = "Mauvais login ou mauvais mot de passe";
          }
        } else {
            // $erreurs[] = "";
            if(isset($_POST["password"]) && $_POST["password"]== ""){
                $erreurs[]="erreur de  mot de passe";
            }
              
              if(isset($_POST["email"]) && $_POST["email"]==""){
                $erreurs[]= "erreur d' email";
              }
              
            }
          
          
        
      ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
  </head>
  <body>
      <h1>LOGIN</h1>
      
      <?php
       if($isAuth){
         echo "<h3> vous êtes authentifié </h3>";
       }else{
       foreach ($erreurs as $erreur) {
         echo $erreur. '<h4>erreur de saisie</h4>';
       }
      }
      ?>
<div class="container">
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" name="adresse" placeholder="1234 Main St">
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" name="city" id="inputCity">
    </div>
    
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
  
</form>
</div>
<br>





      <?php require_once('inc/footer.php') ?>
  </body>