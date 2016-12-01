<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\Item;
use danfekete\Recommender\Contracts\ItemList;

class ArrayItemList extends \ArrayObject implements ItemList
{

    /**
     * Get the item with a given ID
     * @param $id
     * @return Item
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * See if list contains item with ID
     * @param $id
     * @return boolean
     */
    public function has($id)
    {
        return $this->offsetExists($id);
    }

    /**
     * Return the full list of items
     * @return array|Item[]
     */
    public function all()
    {
        return $this->getArrayCopy();
    }
}