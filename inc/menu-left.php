<div class="col-lg-3">
                  <h1 class="my-4">Bonjour 
                  <?php 
                  if(isset($_SESSION["prenom"])){
                      $personne = $_SESSION["prenom"];
                      
                  }else if (isset($_COOKIE["prenom"])){
                    $personne = $_COOKIE["prenom"];
                  }
                  
                  else {
                    $personne = "toi";
                  }

                  echo $personne;
                  ?></h1>
                  
          <p>Aujourd'hui nous somme le <?php echo date('d/m/Y'). '<br> et il est '.date('H:i:s') ?></p>
          
        <h2>Nos supers livres</h2>
        <div class="list-group">
 
        <?php
         require_once('fonctions.php');
          menuTop3($livres);

        ?>
        </div>

      </div>
