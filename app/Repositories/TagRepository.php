<?php

namespace App\Repositories;

use App\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends AbstractRepository implements TagRepositoryInterface
{
    /**
     * Model class.
     *
     * @var string
     */
    protected $model = \App\Tag::class;

    /**
     * Fill an tag model.
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
