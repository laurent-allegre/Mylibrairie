<h1>Fonctions</h1>
<?php


function menuTop3($livres){
    for ($i=0; $i <3 ; $i++) { 
        echo  '<a href="item.php?idlivre='.$i.' "class="list-group-item">';
        echo $livres[$i]["titre"];
        echo'</a>';
      }
}











?>