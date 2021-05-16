<?php

namespace App\Models;

use App\Abstracts\ModelAbstract;
use App\App;
use Illuminate\Database\Eloquent\Model;

class Cargo extends ModelAbstract
{
    protected $table = 'cargoes';
    protected $fillable = ['user_id', 'status', 'shipper', 'receiver', 'name', 'amount', 'weight'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arrival()
    {
        return $this->hasOne(CargoArrival::class);
    }

    public function departure()
    {
        return $this->hasOne(CargoDeparture::class);
    }

    public function comments()
    {
        return $this->hasMany(CargoComment::class);
    }

    public function files()
    {
        return $this->hasMany(CargoFile::class);
    }

    public function isShipped()
    {
        return $this->status === App::CARGO_STATUS_SHIPPED;
    }

    public function isArrived()
    {
        return $this->status === App::CARGO_STATUS_ARRIVED;
    }

    public function isDepartured()
    {
        return $this->status === App::CARGO_STATUS_DEPARTURED;
    }
}
