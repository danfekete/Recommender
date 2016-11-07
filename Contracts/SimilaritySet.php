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
     * Return the similarity score for a given user
     * @param $user
     * @return double
     */
    public function getSimilarityIndex($user);
}