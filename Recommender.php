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
}