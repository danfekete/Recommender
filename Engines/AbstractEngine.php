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
     * Get a similarity set filtered to similar users to a given user
     * @param $user
     * @return SimilaritySet
     */
    public function getSimilarUsers($user)
    {
        // Uses the Jaccard similarity coefficient
        $currentPurchaseList = $this->dataSet->getListForKey($user)->all();
        $others = $this->dataSet->getAvailableKeys($user);

        // TODO: make it configurable
        $similar = new SimilaritySet();

        foreach ($others as $other) {
            $otherPurchaseList = $this->dataSet->getListForKey($other)->all();
            $combined = count(array_merge($currentPurchaseList, $otherPurchaseList));
            if ($combined == 0) continue;
            $intersection = array_uintersect($currentPurchaseList, $otherPurchaseList, function ($a, $b) {
                /** @var Item $a */
                /** @var Item $b */
                if ($a->getId() == $b->getId()) return 0;
                return $a->getId() < $b->getId() ? -1 : 1;
            });

            $intersectionCount = count($intersection);
            $jaccIndex = $intersectionCount / ($combined - $intersectionCount);
            $similar->add(new SimilarityItem($other, $jaccIndex));
        }

        return $similar;
    }
}