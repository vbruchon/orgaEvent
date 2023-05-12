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
        return $this->belongsTo(Structure::class);
    }

    public function partners()
    {
        return $this->belongsToMany(Partners::class, 'event-partner');
    }
}
