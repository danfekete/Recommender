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
use danfekete\Recommender\Contracts\SimilaritySet;
use danfekete\Recommender\Models\SimiliaritySet;

class JaccardEngine implements SimilarityEngine
{
    /**
     * @var DataSet
     */
    private $dataSet;

    /**
     * EuclidanEngine constructor.
     */
    public function __construct()
    {
    }


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
        $currentPurchaseList = $this->dataSet->getUserPurchases($user)->all();
        $others = $this->dataSet->getAvailableUsers($user);

        // TODO: make it configurable
        $similar = new SimiliaritySet();

        foreach ($others as $other) {
            $otherPurchaseList = $this->dataSet->getUserPurchases($other)->all();
            $combined = count(array_merge($currentPurchaseList, $otherPurchaseList));
            if($combined == 0) continue;
            $intersection = array_uintersect($currentPurchaseList, $otherPurchaseList, function($a, $b) {
                /** @var Item $a */
                /** @var Item $b */
                if($a->getId() == $b->getId()) return 0;
                return $a->getId() < $b->getId() ? -1 : 1;
            });

            $intersectionCount = count($intersection);
            $jaccIndex = $intersectionCount / ($combined - $intersectionCount);
            $similar[$other] = $jaccIndex;
        }

        return $similar;
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