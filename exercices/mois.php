<?php 
    $mois = [
         1 => [
                "fr" => "janvier",
                "en" => "january"
                ],
            2 => [
                "fr" => "fevrier",
                "en" => "february"
            ],
            3 => [
                "fr" => "mars",
                "en" => "march"
            ],
            4 => [
                "fr" => "avril",
                "en" => "april"
            ],
            5 => [
                "fr" => "mai",
                "en" => "may"
            ],
            6 => [
                "fr" => "juin",
                "en" => "june"
            ],
            7 => [
                "fr" => "juillet",
                "en" => "jully"
            ],
            8 => [
                "fr" => "aout",
                "en" => "august"
            ],
            9 => [
                "fr" => "septembre",
                "en" => "september"
            ],
            10 => [
                "fr" => "octobre",
                "en" => "october"
            ],
            11 => [
                "fr" => "novembre",
                "en" => "november"
            ],
            12 => [
                "fr" => "decembre",
                "en" => "december"
                ]
            
        ];
echo "<p>les 12 mois en francais</p>";
for ($i=1; $i <=12 ; $i++) { 
    echo $i." ";
    echo $mois[$i]["fr"]."<br>";
}
echo "<p>les 6 mois en francais</p>";
for ($i=1; $i <=6 ; $i++) { 
    echo $i." ";
    echo $mois[$i]["fr"]."<br>";
}
echo "<p>les 6 mois en anglais</p>";
for ($i=1; $i <=6 ; $i++) { 
    echo $mois[$i]["en"]."<br>";
}
echo "<p>le 3eme mois</p>";
echo $mois[3]["fr"];

$moisEnFrancais = array();
for ($i=1; $i <=12 ; $i++){
$moisEnFrancais[$i] = $mois [$i]["fr"];
}
var_dump ($moisEnFrancais);

//rajoute un élément dans un tableau
$mois[1]["de"]="januar";
$mois[2]["de"]="februar";
$mois[3]["de"]="märz";
var_dump($mois);

function sixPremiersMois($listeMois){
    echo"<h1>Voici ma premiere fonction PHP</h1>";
    for ($i=1; $i <=6 ; $i++) { 
        echo $i." - ";
        echo $listeMois[$i]["fr"]."<br>";
    }
}

sixPremiersMois($mois);
?>