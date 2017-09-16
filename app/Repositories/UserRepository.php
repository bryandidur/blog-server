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
     * Delete an user.
     *
     * @param  object $user
     * @return bool
     */
    public function delete($user)
    {
        $this->deleteAllRelationships($user);

        return $user->delete();
    }

    /**
     * Delete all user relationships.
     *
     * @param  object $user
     * @return void
     */
    public function deleteAllRelationships($user)
    {
        if( $user->files ) {
            $user->files()->delete();
        }

        if( $user->tags ) {
            $user->tags()->delete();
        }

        if( $user->categories ) {
            $user->categories()->delete();
        }

        if( $user->articles ) {
            $user->articles()->delete();
        }
    }

    /**
     * Fill an user model and encrypt its password.
     *
     * @param  object $user
     * @param  array  $data
     * @return void
     */
    public function fill($user, array $data = [])
    {
        if ( isset($data['password']) ) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->fill($data);
    }
}
