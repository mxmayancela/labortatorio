<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'citys';

    protected $fillable = [
        'cityname',
        'id_province',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province');
    }

    public function routes_origin()
    {
        return $this->hasMany(Route::class, 'id_city_origin');
    }

    public function routes_destination()
    {
        return $this->hasMany(Route::class, 'id_city_destination');
    }
}
