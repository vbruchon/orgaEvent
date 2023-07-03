<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function number_of_participants(){
        return $this->belongsTo(NumberOfParticipants::class, 'number_of_participants_id');
    }
}
