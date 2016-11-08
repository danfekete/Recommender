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
     * Calculate the similarity between two lists
     * @param ItemList $a
     * @param ItemList $b
     * @return double
     */
    function calculateSimilarity($a, $b)
    {
        $currentKeyList = $a->all();
        $otherKeyList = $b->all();
        $combined = count(array_merge($currentKeyList, $otherKeyList));
        if ($combined == 0) return 0;
        $intersection = array_uintersect($currentKeyList, $otherKeyList, function ($a, $b) {
            /** @var Item $a */
            /** @var Item $b */
            if ($a->getId() == $b->getId()) return 0;
            return $a->getId() < $b->getId() ? -1 : 1;
        });

        $intersectionCount = count($intersection);
        return $intersectionCount / ($combined - $intersectionCount);
    }
}