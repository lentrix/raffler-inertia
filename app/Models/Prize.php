<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $fillable = ['name','description','sponsor','raffle_id'];

    public function raffle() {
        return $this->belongsTo('App\Models\Raffle');
    }
}
