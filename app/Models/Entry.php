<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    use HasFactory;

    protected $fillable = ['ticket_no','name','description','raffle_id'];

    public function raffle() {
        return $this->belongsTo('App\Models\Raffle');
    }

    public function draws() {
        return $this->hasMany('App\Models\Draw');
    }
}
