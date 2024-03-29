<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    function roomtypeImages(){
        return $this->hasMany(RoomtypeImage::class,'room_type_id');
    }
}
