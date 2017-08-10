<?php

namespace App\Repositories;

use DB;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\AbstractRepositoryInterface;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * Model class.
     *
     * @var string
     */
    protected $model;

    /**
     * Get all records from model.
     *
     * @param  int|null  $limit
     * @param  boolean   $paginate
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all($limit = null, $paginate = false)
    {
        if ( $limit && $paginate ) {
            return $this->newQuery()->paginate($limit);
        }

        return $this->newQuery()->limit($limit)->get();
    }

    /**
     * Find an specific record by its primary key.
     *
     * @param  int     $id
     * @param  boolean $fail
     * @param  array   $columns
     * @return object  Model class
     */
    public function find($id, $fail = true, $columns = ['*'])
    {
        if ( $fail ) {
            return $this->newQuery()->findOrFail($id, $columns);
        }

        return $this->newQuery()->find($id, $columns);
    }

    /**
     * Store a new record.
     *
     * @param  array  $data
     * @return object Model class
     */
    public function create(array $data = [])
    {
        $model = $this->factory($data);

        return $this->save($model);
    }

    /**
     * Store bulk records.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function bulkCreate(array $data)
    {
        $data = collect($data);
        $timestamp = date('Y-m-d H:i:s');

        $data->transform(function ($item, $key) use($timestamp) {
            return collect($item)->merge([
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        });

        DB::table($this->factory()->getTable())->insert($data->toArray());

        return $data;
    }

    /**
     * Update an model.
     *
     * @param  object $model
     * @param  array  $data
     * @return object Model class
     */
    public function update($model, array $data = [])
    {
        $this->fill($model, $data);

        return $this->save($model);
    }

    /**
     * Delete an model.
     *
     * @param  object $model
     * @return bool
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * Delete bulk models.
     *
     * @param  Collection $models
     * @return bool
     */
    public function bulkDelete(Collection $models)
    {
        $ids = $models->pluck('id')->toArray();

        return $this->factory()->whereIn('id', $ids)->delete();
    }

    /**
     * Create a new query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return app()->make($this->model)->newQuery();
    }

    /**
     * Create a new model object and fill it.
     *
     * @param  array  $data
     * @return object
     */
    public function factory(array $data = [])
    {
        $model = $this->newQuery()->getModel()->newInstance();

        $this->fill($model, $data);

        return $model;
    }

    /**
     * Fill an model.
     *
     * @param  object $model
     * @param  array  $data
     * @return void
     */
    public function fill($model, array $data = [])
    {
        $model->fill($data);
    }

    /**
     * Save an filled model.
     *
     * @param  object $model
     * @return object Model class
     */
    public function save($model)
    {
        $model->save();

        return $model;
    }
}
