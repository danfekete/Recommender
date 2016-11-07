<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 * daniel.fekete@voov.hu
 */

namespace danfekete\Recommender\Contracts;


interface DataSet
{
    /**
     * Get the purchases made by a given user
     * @param $user
     * @return ItemList
     */
    public function getUserPurchases($user);
}