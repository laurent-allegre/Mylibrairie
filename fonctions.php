
<?php


/**
 * menuTop3
 *
 * @param  mixed $livres
 *
 * @return void
 */
function menuTop3($livres){
    for ($i=0; $i <3 ; $i++) { 
        echo  '<a href="item.php?idlivre='.$i.' "class="list-group-item">';
        echo $livres[$i]["titre"];
        echo'</a>';
      }
}











?>