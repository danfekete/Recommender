<?php
use League\Csv\Reader;

/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */
class RecommendationEngine
{
    protected $dataset;

    /**
     * RecommendationEngine constructor.
     */
    public function __construct($filename)
    {

        $this->dataset = $this->loadDataset($filename);

    }


    /**
     * Load the dataset from file
     * @param $file
     * @return array
     */
    private function loadDataset($file)
    {
        $reader = Reader::createFromPath($file);
        $result = $reader->fetchAssoc(0);

        $dataset = [];
        foreach ($result as $item) {
            if (empty($dataset[$item['name']])) $dataset[$item['name']] = [];
            $dataset[$item['name']][] = $item['product_id'];
        }
        return $dataset;
    }

    /**
     * Get value from dataset
     * @param $name
     * @param $id
     * @return int
     */
    private function get($name, $id) {
        if (in_array($id, $this->dataset[$name])) return 1;
        return 0;
    }

    private function euc_similar($nameA, $nameB) {
        $dist = 0;
        foreach ($this->dataset[$nameA] as $id ) {
            $valueB = $this->get($nameB, $id);
            $dist += pow($valueB - 1, 2);
        }
        return 1 / 1 + sqrt($dist);
    }

    /**
     * Calculate similarity
     * @param $dataset
     * @param $similarityMatrix
     * @return mixed
     */
    private function calculateSimilarity($name)
    {
        $similarityMatrix = [];
        //foreach ($this->dataset as $name => $purchases) {
            foreach ($this->dataset as $otherName => $otherPurchases) {
                if ($name == $otherName) continue;
                $similarityMatrix[$otherName] = $this->euc_similar($name, $otherName);
            }
        arsort($similarityMatrix);
        return $similarityMatrix;
    }

    /**
     * Get the recommended product list
     * @param $name
     * @return array
     */
    public function recommendations($name) {
        // get the first 3 most similar user
        $similarGroups = array_slice($this->calculateSimilarity($name), 0, 3);
        r($similarGroups);
        $similarItems = [];

        foreach (array_keys($similarGroups) as $key) {
            // this is the first user
            if(empty($similarItems)) $similarItems = $this->dataset[$key];
            else $similarItems = array_intersect($similarItems, $this->dataset[$key]); // instead of intersection we should count the number of similar user bought the item
        }

        return array_unique($similarItems);
    }
}