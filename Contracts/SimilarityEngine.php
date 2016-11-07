<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


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
     * Get a similarity set filtered to similar users to a given user
     * @param $user
     * @return SimilaritySet
     */
    public function getSimilarUsers($user);

    /**
     * Get similar items to the given item
     * @param Item $item
     * @return ItemList
     */
    public function getSimilarItems(Item $item);
}