<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\SimilarityItem;
use danfekete\Recommender\Contracts\SimilaritySet as SimilaritySetContract;

class SimilaritySet implements SimilaritySetContract
{

    /**
     * @var array|SimilarityItem[]
     */
    private $list = [];

    /**
     * Return the similarity score for a given ID
     * @param $keyID
     * @return double
     */
    public function getSimilarityIndex($keyID)
    {
        foreach ($this->list as $item) {
            if($item->getID() == $keyID) return $item->getValue();
        }

        return 0;
    }

    /**
     * Return the whole set sorted
     * @return array
     */
    public function all()
    {
        return $this->list;
    }


    /**
     * Get top N elem
     * @param int $n
     * @return array
     */
    public function top($n = 3)
    {
        return array_slice($this->list, 0, $n);
    }

    /**
     * Add a similarity to the given ID
     * @param SimilarityItem $item
     */
    public function add(SimilarityItem $item)
    {
        $this->list[] = $item;
        usort($this->list, function($a, $b) {

            if($a->getValue() == $b->getValue()) return 0;
            return $a->getValue() < $b->getValue() ? 1 : -1;
        });
    }
}