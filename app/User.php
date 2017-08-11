<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route for password reset.
     *
     * @var string
     */
    public static $passwordResetRoute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $link = str_replace('{token}', $token, self::$passwordResetRoute);

        $this->notify(new ResetPasswordNotification($link));
    }

    /**
     * Has-many user tags relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tags()
    {
        return $this->hasMany(\App\Tag::class);
    }

    /**
     * Has-many user categories relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->hasMany(\App\Category::class);
    }

    /**
     * Has-many user articles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function articles()
    {
        return $this->hasMany(\App\Article::class);
    }

    /**
     * Has-many user articles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function files()
    {
        return $this->hasMany(\App\File::class);
    }
}
