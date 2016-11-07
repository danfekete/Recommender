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

    /**
     * Return a list of available users
     * @param null|string|array $exclude one ore more users to exclude from the list
     * @return array
     */
    public function getAvailableUsers($exclude=null);
}