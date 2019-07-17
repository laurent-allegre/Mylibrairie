
<?php


/**
 * menuTop3
 *
 * @param  mixed $livres
 *
 * @return void
 */
function menuTop3($dbh, $nb=3){
    $sql = "SELECT
    livre.id_livre as id_livre,
    livre.titre as titre
    from livre
    order by titre ASC
    limit :nombre ";
    $req = $dbh->prepare($sql);
    $req->bindValue(':nombre', intval(trim($nb)), PDO::PARAM_INT);
    $req->execute();
    $livres = $req->fetchALL();
    foreach($livres as $livre){
      echo'<a href="item.php?livre='.$livre["id_livre"].'class="list-group-item">';
      echo $livre["titre"];
      echo "</a>";
    }
  }

      
