<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Notifications\ResetPasswordPersonalizado;

class User extends Authenticatable
{
    use Notifiable,ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function rol(){

    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordPersonalizado($token));
    }
}
