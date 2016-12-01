<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


interface SimilarityItem
{
    /**
     * Return the ID for the item
     * @return mixed
     */
    public function getID();

    /**
     * Return the similarity index for the given ID
     * @return double
     */
    public function getValue();
}