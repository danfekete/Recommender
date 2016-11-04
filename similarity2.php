<?php
ini_set('date.timezone', 'UTC');
require_once 'vendor/autoload.php';
require_once 'RecommendationEngine.php';

$recommendation = new RecommendationEngine('data/purchases2.csv');
r($recommendation->recommendations('B'));