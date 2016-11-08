<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\SimilarityItem as SimilarityItemContract;

class SimilarityItem implements SimilarityItemContract, \JsonSerializable
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $value;

    /**
     * SimilarityItem constructor.
     */
    public function __construct($id, $value)
    {
        $this->id = $id;
        $this->value = $value;
    }


    /**
     * Return the ID for the item
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Return the similarity index for the given ID
     * @return double
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Specify data which should be serialized to JSON
     * @return mixed data which can be serialized by <b>json_encode</b>,
     */
    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'value' => $this->value
        ];
    }
}