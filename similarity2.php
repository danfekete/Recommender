<?php
ini_set('date.timezone', 'UTC');
require_once 'vendor/autoload.php';

$reader = \League\Csv\Reader::createFromPath('data/purchases2.csv');
$result = $reader->fetchAssoc(0);

$dataset = [];
$similarityMatrix = [];

foreach ($result as $item) {
    if(empty($dataset[$item['name']])) $dataset[$item['name']] = [];
    $dataset[$item['name']][] = $item['product_id'];
}

function get($name, $id) {
    global $dataset;
    if (in_array($id, $dataset[$name])) return 1;
    return 0;
}

//~r($dataset);

function euc_similar($nameA, $nameB) {
    global $dataset;
    $dist = 0;
    foreach ($dataset[$nameA] as $id ) {
        $valueB = get($nameB, $id);
        $dist += pow($valueB - 1, 2);
    }
    return 1 / 1 + sqrt($dist);
}

function recommendations($name) {
    global $similarityMatrix;
    global $dataset;
    $similarGroups = array_slice($similarityMatrix[$name], 0, 3);
    $similarItems = [];
    foreach (array_keys($similarGroups) as $key) {
        if(empty($similarItems)) $similarItems = $dataset[$key];
        else $similarItems = array_intersect($similarItems, $dataset[$key]);
    }

    return $similarItems;
}

// which customers are the most similar
foreach ($dataset as $name => $purchases) {

    //$excepted = array_except($name, $dataset);

    foreach ($dataset as $otherName => $otherPurchases) {

        if($name == $otherName) continue;
        $similarityMatrix[$name][$otherName] = euc_similar($name, $otherName);

    }

}


foreach ($similarityMatrix as &$item) {
    arsort($item);
}

r($similarityMatrix);
r(recommendations('F'));
