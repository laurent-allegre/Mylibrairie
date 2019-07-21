<h1>fonction calcul des périmétres</h1>
<?php
//return appelle une fonction echo une methode
function perimetreCarre($cote){
    $perimetre = $cote * 4;
    echo $perimetre ."<br>";
  //  return $perimetre ."<br>";
}
function perimetreRectangle($long, $larg){
    $perimetreRectangle =  ($long + $larg) * 2;
    echo $perimetreRectangle ."<br>"."<p>perimetre du rectangle</p>";

}
function perimetreCercle($rayon){
    $perimetreCercle = 2* pi() * $rayon;
    echo round($perimetreCercle ,2)."<br>"."<p>perimetre du cercle</p>";
}
function perimetreTriangle($cote1, $cote2, $cote3){
    $perimetreTriangle = $cote1 + $cote2 + $cote3;
    echo "<h2>perimetre du triangle</h2><p>". $perimetreTriangle ."<br></p>";
}
perimetreTriangle(20, 50, 36);

perimetreCercle(20);

perimetreRectangle (20, 10);


perimetreCarre(2);
perimetreCarre(3);

?>