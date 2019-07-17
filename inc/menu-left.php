<div class="col-lg-3">
                  
                  <?php
                  require_once('my-sql-connect.php');
                  require_once('fonctions.php');
                  /**
           * Récupération du prénom
           */
          if(isset($_SESSION["id_client"]) || isset($_COOKIE["id_client"])) {
            if (isset($_SESSION["id_client"])) {
                $id = $_SESSION["id_client"];
            } else if (isset($_COOKIE["id_client"])) {
                $id = $_COOKIE["id_client"];
            }
            $sql = "SELECT prenom
              FROM client 
              WHERE id_client = :id
              ";
            $req = $dbh->prepare($sql);
            $req->bindParam(':id', $id);
            $req->execute();
            $personne = $req->fetch()["prenom"];
        }
        else {
            $personne = "toi";
        }
        ?>
                <h1 class="my-4">Bonjour <?php echo $personne ?></h1>
                  
          <p>Aujourd'hui nous somme le <?php echo date('d/m/Y'). '<br> et il est '.date('H:i:s') ?></p>
          
        <h2>Nos supers livres</h2>
        <div class="list-group">
 
        <?php
         
          menuTop3($dbh);

        ?>
        </div>

      </div>
