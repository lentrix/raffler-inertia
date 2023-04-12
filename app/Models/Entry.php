<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['ticket_no','name','description','raffle_id'];

    public function raffle() {
        return $this->belongsTo('App\Models\Raffle');
    }
}
