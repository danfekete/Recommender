<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender;


use danfekete\Recommender\Contracts\DataSet;
use danfekete\Recommender\Contracts\SimilarityEngine;
use danfekete\Recommender\Contracts\SimilaritySet;

class Recommender
{
    /**
     * @var SimilarityEngine
     */
    private $engine;
    /**
     * @var DataSet
     */
    private $dataSet;

    /**
     * Recommender constructor.
     */
    public function __construct(SimilarityEngine $engine, DataSet $dataSet)
    {
        $this->engine = $engine;
        $this->dataSet = $dataSet;

        $this->engine->setDataset($dataSet);
    }


    /**
     * Get similarity set for one key
     * @param $key
     * @return Models\SimilaritySet
     */
    public function getOne($key)
    {
        return $this->engine->getSimilar($key);
    }

    /**
     * Get every similarity for every item
     * @return array|SimilaritySet[]
     */
    public function getAll()
    {
        $similarityMatrix = [];
        $allKeys = $this->engine->getDataset()->getAvailableKeys();
        foreach ($allKeys as $key) {
            $similarityMatrix[$key] = $allKeys;
        }

        return $similarityMatrix;
    }
}