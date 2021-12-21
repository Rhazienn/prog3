<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Usuario extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    protected $hidden = [
        'password',
    ];

    use HasFactory;

    function getAuthIdentifierName(){
        return 'id';
    }
    
    function getAuthIdentifier(){
        return $this->id;
    }

    function getAuthPassword(){
        return $this->password;
    }

    function getRememberToken(){
        return $this->remember_token;
    }

    function setRememberToken($value){
        $this->remember_token = $value;
    }

    function getRememberTokenName(){
        return 'remember_token';
    }

    public $timestamps = false;
}
