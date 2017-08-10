<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface AbstractRepositoryInterface
{
    /**
     * Get all records from model.
     *
     * @param  int|null  $limit
     * @param  boolean   $paginate
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all($limit = null, $paginate = false);

    /**
     * Find an specific record by its primary key.
     *
     * @param  int     $id
     * @param  boolean $fail
     * @param  array   $columns
     * @return object  Model class
     */
    public function find($id, $fail = true, $columns = ['*']);

    /**
     * Store a new record.
     *
     * @param  array  $data
     * @return object Model class
     */
    public function create(array $data = []);

    /**
     * Store bulk records.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function bulkCreate(array $data);

    /**
     * Update an model.
     *
     * @param  object $model
     * @param  array  $data
     * @return object Model class
     */
    public function update($model, array $data = []);

    /**
     * Delete an model.
     *
     * @param  object $model
     * @return bool
     */
    public function delete($model);

    /**
     * Delete bulk models.
     *
     * @param  Collection $models
     * @return bool
     */
    public function bulkDelete(Collection $models);

    /**
     * Create a new query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery();

    /**
     * Create a new model object and fill it.
     *
     * @param  array  $data
     * @return object
     */
    public function factory(array $data = []);

    /**
     * Fill an model.
     *
     * @param  object $model
     * @param  array  $data
     * @return void
     */
    public function fill($model, array $data = []);

    /**
     * Save an filled model.
     *
     * @param  object $model
     * @return object Model class
     */
    public function save($model);
}
