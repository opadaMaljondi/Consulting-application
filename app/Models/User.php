<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name' ,
            'email' ,
            'password',
            'excpert',
    ];


    public $table = 'users';
    public $timestamps = false;


   public function excpert()
   {
       return $this->hasOne(Excpert::class, 'excpert_id', 'id');
   }
}
