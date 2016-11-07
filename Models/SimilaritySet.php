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

class SimilaritySet implements SimilaritySetContract, \Iterator
{
    /** @var SimilarityItem $root  */
    private $root;
    /** @var SimilarityItem $current */
    private $current;
    /** @var SimilarityItem $next */
    private $next;

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->current = $this->next;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->current->getID();
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->current != null;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->current = $this->root;
    }

    /**
     * Return the similarity score for a given ID
     * @param $keyID
     * @return double
     */
    public function getSimilarityIndex($keyID)
    {
        // TODO: Implement getSimilarityIndex() method.
    }

    /**
     * Add a similarity to the given ID
     * @param SimilarityItem $item
     */
    public function add(SimilarityItem $item)
    {
        if ($this->root == null) $this->root = $item;
    }
}