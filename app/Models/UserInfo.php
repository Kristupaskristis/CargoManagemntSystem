<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'users_info';

    protected $fillable = [
        'user_id','name','surname','company','position','phone_number'
    ];

    public function info()
    {
        return $this->belongsTo(User::class);
    }
}
