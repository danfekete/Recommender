<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Storages;


use danfekete\Recommender\Contracts\SimilaritySet;
use danfekete\Recommender\Contracts\SimilarityStore;
use danfekete\Recommender\Models\SimilarityItem as SimilarityItemModel;
use danfekete\Recommender\Models\SimilaritySet as SimilaritySetModel;
use PDO;

class SqliteStore implements SimilarityStore
{
    protected $db;

    /**
     * SqliteStore constructor.
     */
    public function __construct($filename)
    {
        $exists = file_exists($filename);
        $this->db = new PDO('sqlite:' . $filename);
        if(!$exists) $this->initTable();
    }

    /**
     * @param $key
     */
    private function getStmt($key)
    {
        $stmt = $this->db->prepare('SELECT similar FROM similar WHERE key=?');
        //~r($this->db->errorInfo());
        $stmt->execute([$key]);
        return $stmt;
    }

    private function initTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS similar (key TEXT PRIMARY KEY,similar TEXT);";
        $this->db->exec($sql);
    }

    /**
     * Store the similarity set for a key
     * @param $key
     * @param $set SimilaritySet
     */
    public function store($key, $set)
    {
        $stmt = $this->db->prepare('INSERT INTO similar (key, similar) VALUES(?, ?)');
        $setSerialized = json_encode($set->all());
        $stmt->execute([$key, $setSerialized]);
    }

    /**
     * Get the Similarity set for a given key
     * @param $key
     * @return SimilaritySet|boolean
     */
    public function get($key)
    {
        $row = $this->getStmt($key)->fetch(PDO::FETCH_ASSOC);
        if(!$row) return false;

        $similar = json_decode($row["similar"], true);
        $similarMapped = array_map(function($item) {

            return new SimilarityItemModel($item['id'], $item['value']);

        }, $similar);
        return new SimilaritySetModel($similarMapped);
    }

    /**
     * Check if key exists in store
     * @param $key
     * @return boolean
     */
    public function has($key)
    {
        if(!$this->getStmt($key)->fetch()) return false;
        return true;
    }
}