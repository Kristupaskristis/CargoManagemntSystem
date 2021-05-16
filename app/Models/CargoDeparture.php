<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoDeparture extends Model
{
    protected $table = 'cargoes_departures';
    protected $fillable = ['cargo_id', 'plate_number', 'departure_date'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
