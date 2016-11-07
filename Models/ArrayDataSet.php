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
     * @param $user
     * @return ItemList
     */
    public function getUserPurchases($user)
    {
        return $this->offsetGet($user);
    }
}