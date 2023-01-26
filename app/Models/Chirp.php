<?php

namespace App\Models;

use App\Events\ChirpCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    use HasFactory;

    //[5] Permite la insercion masiva de datos -> _create_chirps_table.php
    protected $fillable = [
        'message',
    ];

    //[16] Eloquent se encargara de mandar el mensaje cada vez que ocurra el evento de registro -> SendChirpCreatedNotifications.php
    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];

    //[8] Agregamos la relacion de user con chirp -> web.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
