<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

require_once 'vendor/autoload.php';

class Item {
    public $name;

    /**
     * Item constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

}

$a = new Item('a');
$b = new Item('b');
$c = new Item('c');
$d = new Item('d');

$aa = [$a, $b, $c];
$ba = [$b, $c, $d];

$intersect = array_uintersect($aa, $ba, function($a, $b) {
    /** @var Item $a */
    /** @var Item $b */

    return strcmp($a->name, $b->name);
});
$merged = array_merge($aa, $ba);
$ic = count($intersect);
$mc = count($merged);
r($mc, $ic);
r($merged);
r($ic / ($mc - $ic));