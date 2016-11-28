<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\DataSet as DataSetContract;
use danfekete\Recommender\Contracts\ItemList;

class ArrayDataSet extends \ArrayObject implements DataSetContract
{
    /**
     * Get the purchases made by a given user
     * @param $key
     * @return ItemList
     */
    public function getListForKey($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Return a list of available users
     * @param null|string|array $exclude one ore more users to exclude from the list
     * @return array
     */
    public function getAvailableKeys($exclude=null)
    {
        return [];
    }
}