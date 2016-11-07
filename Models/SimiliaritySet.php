<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\SimilaritySet as SimilaritySetContract;

class SimiliaritySet  implements SimilaritySetContract
{

    /**
     * Add a similarity to the given ID
     * @param $keyID
     * @param $similarity
     */
    public function add($keyID, $similarity)
    {
        // TODO: Implement add() method.
    }

    /**
     * Return the similarity score for a given ID
     * @param $keyID
     * @return double
     */
    public function getSimilarityIndex($keyID)
    {
        // TODO: Implement getSimilarityIndex() method.
    }
}