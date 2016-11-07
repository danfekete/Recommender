<?php
ini_set('date.timezone', 'UTC');
require_once 'vendor/autoload.php';
require_once 'RecommendationEngine.php';

$start = microtime(true);
$recommendation = new RecommendationEngine('data/purchases2.csv');
r($recommendation->recommendations('B'));

r(microtime(true) - $start);