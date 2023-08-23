<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $table = 'bus';

    protected $fillable = [
        'unitnumber',
        'licenseplate',
        'model',
        'capacity',
        'year',
        'id_carrier',
    ];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class, 'id_carrier');
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'id_bus');
    }
}
