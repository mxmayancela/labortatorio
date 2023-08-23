<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table='persons';
    protected $primaryKey='id';
    protected $fillable = [
        'name',
        'lastnamefather',
        'lastnamemother',
        'cedula',
        'birthdate',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function carrier()
    {
        return $this->hasOne(Carrier::class);
    }
}
