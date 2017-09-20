<?php

namespace App\Repositories\Contracts;

interface ArticleRepositoryInterface
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

    /**
     * Find an specific record by its primary key and return it and its relationships.
     *
     * @param  int          $id
     * @param  string|array $relations
     * @param  boolean      $fail
     * @param  array        $columns
     * @return object  Model class and its relationships classes
     */
    public function findWith($id, $relations, $fail = true, $columns = ['*']);
}
