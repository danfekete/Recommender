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
use danfekete\Recommender\Contracts\SimilarityStore;

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
     * @var null
     */
    private $similarityStore;

    /**
     * Recommender constructor.
     * @param SimilarityEngine $engine
     * @param DataSet $dataSet
     * @param null|SimilarityStore $similarityStore
     */
    public function __construct(SimilarityEngine $engine, DataSet $dataSet, $similarityStore=null)
    {
        $this->engine = $engine;
        $this->dataSet = $dataSet;

        $this->engine->setDataset($dataSet);
        $this->similarityStore = $similarityStore;
    }

    /**
     * @return SimilarityEngine
     */
    public function getEngine(): SimilarityEngine
    {
        return $this->engine;
    }

    /**
     * @param SimilarityEngine $engine
     * @return Recommender
     */
    public function setEngine(SimilarityEngine $engine): Recommender
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return DataSet
     */
    public function getDataSet(): DataSet
    {
        return $this->dataSet;
    }

    /**
     * @param DataSet $dataSet
     * @return Recommender
     */
    public function setDataSet(DataSet $dataSet): Recommender
    {
        $this->dataSet = $dataSet;
        return $this;
    }

    /**
     * @return null
     */
    public function getSimilarityStore()
    {
        return $this->similarityStore;
    }

    /**
     * @param null $similarityStore
     * @return Recommender
     */
    public function setSimilarityStore($similarityStore)
    {
        $this->similarityStore = $similarityStore;
        return $this;
    }



    /**
     * Get similarity set for one key
     * @param $key
     * @return Contracts\SimilaritySet
     */
    public function getOne($key)
    {
        if(is_null($this->similarityStore)) return $this->engine->getSimilar($key);

        // There is a store engine set
        if($this->similarityStore->has($key)) return $this->similarityStore->get($key);
        $similar = $this->engine->getSimilar($key);
        $this->similarityStore->store($key, $similar);

        return $similar;
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
            $similarityMatrix[$key] = $this->getOne($key);
        }

        return $similarityMatrix;
    }
}