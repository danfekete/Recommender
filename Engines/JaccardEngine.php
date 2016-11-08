<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Engines;


use danfekete\Recommender\Contracts\DataSet;
use danfekete\Recommender\Contracts\Item;
use danfekete\Recommender\Contracts\ItemList;
use danfekete\Recommender\Contracts\SimilarityEngine;
use danfekete\Recommender\Models\SimilarityItem;
use danfekete\Recommender\Models\SimilaritySet;

class JaccardEngine extends AbstractEngine
{

    public function __construct()
    {

    }


    /**
     * Get similar items to the given item
     * @param Item $item
     * @return ItemList
     */
    public function getSimilarItems(Item $item)
    {
        // TODO: Implement getSimilarItems() method.
    }
}