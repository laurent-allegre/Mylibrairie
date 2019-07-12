<div class="col-lg-3">
                  <h1 class="my-4">Bonjour et bienvenue</h1>
                  
          <p>Aujourd'hui nous somme le <?php echo date('d/m/Y'). '<br> et il est '.date('H:i:s') ?></p>
          
        <h2>Nos supers livres</h2>
        <div class="list-group">
 
        <?php
          for ($i=0; $i <3 ; $i++) { 
            echo ' <a href="item.php?idlivre='.$i.' " class="list-group-item">'.$livres[$i]["titre"].'</a>';
          }
        
        ?>
        </div>

      </div>
