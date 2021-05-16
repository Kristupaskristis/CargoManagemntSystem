<?php

namespace App\Abstracts;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

abstract class ModelAbstract extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }
}
