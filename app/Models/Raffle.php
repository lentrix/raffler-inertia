<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{

    protected $fillable = ['name','description','user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function prizes() {
        return $this->hasMany('App\Models\Prize');
    }

    public function entries() {
        return $this->hasMany('App\Models\Entry')->orderBy('name');
    }

    public function getDrawsAttribute() {
        $raffleId = $this->id;
        return Draw::whereHas('prize', function($q) use ($raffleId) {
            $q->where('raffle_id', $raffleId);
        })->with('entry')->with('prize')->get();
    }

    public function getNonWinnersAttribute() {
        $entries = Entry::whereDoesntHave('draws')->get();
        return $entries;
    }
}
