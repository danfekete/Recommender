<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


interface SimilarityStore
{
    /**
     * Store the similarity set for a key
     * @param $key
     * @param $set SimilaritySet
     */
    public function store($key, $set);

    /**
     * Get the Similarity set for a given key
     * @param $key
     * @return SimilaritySet|boolean
     */
    public function get($key);

    /**
     * Check if key exists in store
     * @param $key
     * @return boolean
     */
    public function has($key);
}