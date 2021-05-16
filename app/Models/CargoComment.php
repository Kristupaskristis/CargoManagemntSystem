<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoComment extends Model
{
    protected $table = 'cargoes_comments';
    protected $fillable = ['cargo_id', 'user_id', 'comment'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
