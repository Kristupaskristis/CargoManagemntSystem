<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoArrival extends Model
{
    protected $table = 'cargoes_arrivals';
    protected $fillable = ['cargo_id', 'plate_number', 'arrival_date'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
