<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


interface SimilaritySet
{
    /**
     * Return the similarity score for a given ID
     * @param $keyID
     * @return double
     */
    public function getSimilarityIndex($keyID);

    /**
     * Add a similarity to the given ID
     * @param SimilarityItem $item
     */
    public function add(SimilarityItem $item);

    /**
     * Return the whole set sorted
     * @return array
     */
    public function all();

    /**
     * Get top N elem
     * @param int $n
     * @return array
     */
    public function top($n = 3);
}