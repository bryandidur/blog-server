<?php

namespace App\Repositories;

use App\Repositories\Contracts\ArticleRepositoryInterface;

class ArticleRepository extends AbstractRepository implements ArticleRepositoryInterface
{
    /**
     * Model class.
     *
     * @var string
     */
    protected $model = \App\Article::class;

    /**
     * Find records by slug and optionally with its relationships.
     *
     * @param  string  $slug
     * @param  array   $relations
     * @param  array   $columns
     * @param  boolean $fail
     * @return object  Model class and its relationships classes
     */
    public function findBySlug($slug, $relations = [], $columns = ['*'], $fail = true)
    {
        return $this->findByColumn('slug', $slug, $relations, $columns, $fail);
    }

    /**
     * Find an specific record by its primary key and return it and its relationships.
     *
     * @param  int          $id
     * @param  string|array $relations
     * @param  boolean      $fail
     * @param  array        $columns
     * @return object  Model class and its relationships classes
     */
    public function findWith($id, $relations, $fail = true, $columns = ['*'])
    {
        if ( $fail ) {
            return $this->newQuery()->with($relations)->findOrFail($id, $columns);
        }

        return $this->newQuery()->with($relations)->find($id, $columns);
    }

    /**
     * Store a new record.
     *
     * @param  array  $data
     * @return object Model class
     */
    public function create(array $data = [])
    {
        $data['tags'] = isset($data['tags']) ? $data['tags'] : [];

        $model = $this->save($this->factory($data));

        $model->tags()->attach($data['tags']);
        $model->categories()->attach($data['categories']);

        return $model;
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
        $data['tags'] = isset($data['tags']) ? $data['tags'] : [];

        $this->fill($model, $data);

        $model->tags()->sync($data['tags']);
        $model->categories()->sync($data['categories']);

        return $this->save($model);
    }

    /**
     * Fill an category model.
     *
     * @param  object $model
     * @param  array  $data
     * @return void
     */
    public function fill($model, array $data = [])
    {
        $data['user_id'] = $model->user_id ?: auth()->user()->id;
        $data['slug'] = str_slug($data['title']);

        $model->fill($data);
    }
}
