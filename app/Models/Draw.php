<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    protected $fillable = ['entry_id','prize_id'];

    public function entry() {
        return $this->belongsTo('App\Models\Entry');
    }

    public function prize() {
        return $this->belongsTo('App\Models\Prize');
    }
}
