<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use SoftCascadeTrait;
    protected $softCascade = ['author'];
    public function author()
    {
        return $this->hasOne('App\Author');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','profile_pic','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function updateUser($request, $id){
        $parameters = $request;
        $user = User::find($id);
        foreach ($parameters as $key => $value) {
            $user->{$key} = $value;
		}

        $user->save();
        return $user;
	}
}
