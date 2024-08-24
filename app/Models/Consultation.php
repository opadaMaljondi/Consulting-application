<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'typename',
        'details'
    ];
    protected $table ='consultations';
    protected $primaryKey = 'id';

    public function excperts()
    {
        return $this->hasMany(Excpert::class, 'consultation_id', 'id');
    }
}
