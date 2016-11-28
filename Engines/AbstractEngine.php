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

abstract class AbstractEngine implements SimilarityEngine
{
    /**
     * @var DataSet
     */
    protected $dataSet;

    /**
     * Calculate the similarity between two lists
     * @param ItemList $a
     * @param ItemList $b
     * @return double
     */
    abstract function calculateSimilarity($a, $b);

    /**
     * Set the dataset to use for the similarity calculation
     * @param DataSet $dataset
     */
    public function setDataset(DataSet $dataset)
    {
        $this->dataSet = $dataset;
    }

    /**
     * @return DataSet
     */
    public function getDataset()
    {
        return $this->dataSet;
    }

    /**
     * Get a similarity set filtered to similar keys to a given key
     * @param $key
     * @return SimilaritySet
     */
    public function getSimilar($key)
    {
        // Uses the Jaccard similarity coefficient
        $currentKeyList = $this->dataSet->getListForKey($key);
        $othersKeys = $this->dataSet->getAvailableKeys($key);

        // TODO: make it configurable
        $similar = new SimilaritySet();

        foreach ($othersKeys as $otherKey) {
            $otherKeyList = $this->dataSet->getListForKey($otherKey);

            $similarityScore = $this->calculateSimilarity($currentKeyList, $otherKeyList);
            $similar->add(new SimilarityItem($otherKey, $similarityScore));
        }

        return $similar;
    }
}