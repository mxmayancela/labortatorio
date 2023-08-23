<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table = 'routes';

    protected $fillable = [
        'routename',
        'id_city_origin',
        'id_city_destination',
        'id_bus',
        'date',
        'start_time',
        'end_time',
    ];

    public function city_origin()
    {
        return $this->belongsTo(City::class, 'id_city_origin');
    }

    public function city_destination()
    {
        return $this->belongsTo(City::class, 'id_city_destination');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'id_bus');
    }
}
