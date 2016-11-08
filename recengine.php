<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

require_once 'vendor/autoload.php';

$data = new \danfekete\Recommender\Models\CSVDataSet('data/naurel.csv');
$engine = new \danfekete\Recommender\Engines\JaccardEngine();
$store = new \danfekete\Recommender\Storages\SqliteStore('data/similar.db');


$start = microtime(true);
$rec = new \danfekete\Recommender\Recommender($engine, $data);
$rec->setSimilarityStore($store);

$top = $rec->getOne(164)->top(3);
foreach ($top as $item) {
    r($item->getId(), $item->getValue());
}


r(microtime(true) - $start);