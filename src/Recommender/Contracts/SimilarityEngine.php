<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


use danfekete\Recommender\Models\SimilarityItem;
use danfekete\Recommender\Models\SimilaritySet;

interface SimilarityEngine
{

    /**
     * Set the dataset to use for the similarity calculation
     * @param DataSet $dataset
     */
    public function setDataset(DataSet $dataset);

    /**
     * @return DataSet
     */
    public function getDataset();


    /**
     * Calculate the similarity between two lists
     * @param ItemList $a
     * @param ItemList $b
     * @return double
     */
    function calculateSimilarity($a, $b);

    /**
     * Get a similarity set filtered to similar keys to a given key
     * @param $key
     * @return SimilaritySet
     */
    public function getSimilar($key);
}