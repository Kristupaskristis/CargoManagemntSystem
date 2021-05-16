<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoFile extends Model
{
    protected $table = 'cargoes_files';
    protected $fillable = ['cargo_id', 'user_id', 'file'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
