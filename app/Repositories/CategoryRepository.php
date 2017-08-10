<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     * Model class.
     *
     * @var string
     */
    protected $model = \App\Category::class;

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
        $data['slug'] = str_slug($data['name']);

        $model->fill($data);
    }
}
