<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    /**
     * Find records by slug and optionally with its relationships.
     *
     * @param  string  $slug
     * @param  array   $relations
     * @param  array   $columns
     * @param  boolean $fail
     * @return object  Model class and its relationships classes
     */
    public function findBySlug($slug, $relations = [], $columns = ['*'], $fail = true);
}
