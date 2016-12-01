<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


interface ItemList
{
    /**
     * Get the item with a given ID
     * @param $id
     * @return Item
     */
    public function get($id);

    /**
     * See if list contains item with ID
     * @param $id
     * @return boolean
     */
    public function has($id);

    /**
     * Return the full list of items
     * @return array|Item[]
     */
    public function all();
}