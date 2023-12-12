<?php

    $fruits = [
        "fruit1"=> "Banane",
        "fruit2"=> "Orange",
        "fruit3"=> "Fraise",
    ];

    for ($i = 1; $i <= count($fruits); $i++) {
        echo $fruits['fruit'.$i]."<br>";
    }
    function afficherMessage($combien) {

        $j = 0;
        while ($j <$combien) {
            echo "j'apprends php <br>";
            $j++;
        }
    }
    afficherMessage(15);
    function showFruitsArray(array $fruits):null {
        foreach ($fruits as $key => $value) {  
            echo  $value  . "<br>";
        }
        return null;
    }

    showFruitsArray($fruits);