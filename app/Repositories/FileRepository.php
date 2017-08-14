<?php

namespace App\Repositories;

use DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Contracts\FileRepositoryInterface;

class FileRepository extends AbstractRepository implements FileRepositoryInterface
{
    /**
     * Model class.
     *
     * @var string
     */
    protected $model = \App\File::class;

    /**
     * Find multiple models by their primary keys.
     *
     * @param  array  $ids
     * @param  bool   $fail
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany(array $ids, $fail = true, $columns = ['*'])
    {
        $files = $this->newQuery()->whereKey($ids)->get($columns);

        if ( $files->count() || ! $fail ) {
            return $files;
        }

        throw (new ModelNotFoundException)->setModel(
            get_class($this->newQuery()->getModel()), $ids
        );
    }

    /**
     * Store bulk records.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Collection
     */
    public function bulkCreate(array $data)
    {
        $files = collect($data['files']);
        $timestamp = date('Y-m-d H:i:s');

        $files->transform(function ($file, $key) use ($data, $timestamp) {
            return collect()->merge([
                'user_id'    => auth()->user()->id,
                'disk'       => $data['disk'],
                'name'       => strchr($file->getClientOriginalName(), '.', true),
                'mime'       => $file->getMimetype(),
                'extension'  => $file->getClientOriginalExtension(),
                'path'       => $file->storePubliclyAs('public', str_random(30) . '.' . $file->getClientOriginalExtension(), $data['disk']),
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        });

        DB::table($this->factory()->getTable())->insert($files->toArray());

        return $this->mergeIdsToFilesData($files, $timestamp);
    }

    /**
     * Merge id key to the files data.
     *
     * @param  \Illuminate\Support\Collection $files
     * @param  string  $timestamp
     * @return \Illuminate\Support\Collection
     */
    private function mergeIdsToFilesData(Collection $files, $timestamp)
    {
        // Get newly stored records by its timestamps
        $storedFiles = $this->newQuery()->where('created_at', $timestamp)->get();

        $files->transform(function ($file, $key) use ($storedFiles) {
            return $file->merge([
                'id' => $storedFiles[$key]->id,
            ]);
        });

        return $files;
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
        $this->fill($model, [
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $this->save($model);
    }
}
