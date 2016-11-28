<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


interface DataSet
{
    /**
     * Get itemlist for a given key, for example:
     * get the purchases made by a given user
     * @param $key
     * @return ItemList
     */
    public function getListForKey($key);

    /**
     * Return a list of available keys (for example users)
     * @param null|string|array $exclude one ore more keys to exclude from the list
     * @return array
     */
    public function getAvailableKeys($exclude=null);
}