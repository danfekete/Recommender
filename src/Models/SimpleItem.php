<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\Item;

class SimpleItem implements Item
{
    protected $id;

    /**
     * SimpleItem constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
     * Return the Item's ID
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}