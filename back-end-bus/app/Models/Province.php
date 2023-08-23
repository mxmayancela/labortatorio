<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';

    protected $fillable = [
        'provincename',
        'id_region'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function citys()
    {
        return $this->hasMany(City::class, 'id_province');
    }
}
