<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    public $table = 'rates';
    protected $fillable = [
        'rate',
        'excpert_id'
        ,'user_id'

    ];


}
