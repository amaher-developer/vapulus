<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'room_id', 'user_id', 'message',
    ];
    public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
