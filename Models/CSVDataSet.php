<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Models;


use danfekete\Recommender\Contracts\DataSet;
use danfekete\Recommender\Contracts\ItemList;
use League\Csv\Reader;

class CSVDataSet implements DataSet
{
    /**
     * @var array|ArrayItemList[]
     */
    protected $data = [];

    /**
     * CSVDataSet constructor.
     */
    public function __construct($file, $headerOffset=0, $delim=',')
    {

        $reader = Reader::createFromPath($file);
        $reader->setOffset($headerOffset);
        $reader->setDelimiter($delim);


        foreach ($reader->fetch() as $row) {
            if(count($row) < 2) continue;
            list($key, $value) = array_values($row);
            if(!isset($this->data[$key])) $this->data[$key] = new ArrayItemList();
            $this->data[$key]->append(new SimpleItem($value));
        }

    }


    /**
     * Get itemlist for a given key, for example:
     * get the purchases made by a given user
     * @param $key
     * @return ItemList
     */
    public function getListForKey($key)
    {
        return $this->data[$key];
    }

    /**
     * Return a list of available keys (for example users)
     * @param null|string|array $exclude one ore more keys to exclude from the list
     * @return array
     */
    public function getAvailableKeys($exclude = null)
    {
        $keys =  array_keys($this->data);
        if(is_null($exclude)) return $keys;
        if(!is_array($exclude)) $exclude = (array)$exclude;

        return array_diff($keys, $exclude);
    }
}