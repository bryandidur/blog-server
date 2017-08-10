<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * Model class.
     *
     * @var string
     */
    protected $model = \App\User::class;

    /**
     * Fill an user model and encrypt its password.
     *
     * @param  object $model
     * @param  array  $data
     * @return void
     */
    public function fill($model, array $data = [])
    {
        if ( isset($data['password']) ) {
            $data['password'] = bcrypt($data['password']);
        }

        $model->fill($data);
    }
}
