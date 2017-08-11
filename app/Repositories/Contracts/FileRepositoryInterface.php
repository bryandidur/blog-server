<?php

namespace App\Repositories\Contracts;

interface FileRepositoryInterface
{
    /**
     * Find multiple models by their primary keys.
     *
     * @param  array  $ids
     * @param  bool   $fail
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany(array $ids, $fail = true, $columns = ['*']);
}
