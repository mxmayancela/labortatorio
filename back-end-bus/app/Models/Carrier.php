<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    protected $table = 'carriers';
    protected $fillable = [
        'license',
        'id_person',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }
}
