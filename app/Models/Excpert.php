<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
class Excpert extends Model
{
    use HasFactory;

public $table = 'excperts';
protected $fillable = [
    'user_id',
    'phonenum',
    'consultation_id',
    'adress',
    'price',
    'photo'
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function experiences()
{
    return $this->hasMany(Experience::class, 'excpert_id', 'id');
}
}
