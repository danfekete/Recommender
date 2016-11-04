<?php
$dataset = [

    'dani' => [],
    'peti' => [],
    'bálint' => [],
    'melinda' => [],
    'fanni' => []
];
foreach ($dataset as &$value) {
    $value = array_map(function() {return rand(0, 2);}, array_flip(range(10, 35)));
    //shuffle($value);
    //$value = array_slice($value, 0, 15, false);
}

function euc_similar($nameA, $nameB) {
    global $dataset;
    $dist = 0;
    foreach ($dataset[$nameA] as $id => $valueA ) {
        $valueB = $dataset[$nameB][$id];
        $dist += pow($valueB - $valueA, 2);
    }

    return 1 / 1 + sqrt($dist);
}

$similarityMatrix = [];
foreach ($dataset as $name => $purchases) {

    //$excepted = array_except($name, $dataset);

    foreach ($dataset as $otherName => $otherPurchases) {

        if($name == $otherName) continue;
        $similarityMatrix[$name][$otherName] = euc_similar($name, $otherName);

    }

}

var_dump($similarityMatrix);

