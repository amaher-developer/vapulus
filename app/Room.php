<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name'
    ];
    public function users(){
        return $this->belongsToMany(User::class,'room_user', 'room_id', 'user_id')->withPivot('user_id')->withTimestamps();
    }
}
