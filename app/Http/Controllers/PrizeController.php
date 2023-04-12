<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use App\Models\Raffle;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function create(Raffle $raffle) {
        $raffle->load('prizes');
        return inertia('prizes.create',[
            'raffle' => $raffle,
        ]);
    }

    public function store(Raffle $raffle, Request $request) {
        $request->validate([
            'name' => 'string|required',
        ]);

        $prize = Prize::create([
            'name' => $request->name,
            'description' => $request->description,
            'sponsor' => $request->sponsor,
            'raffle_id' => $raffle->id
        ]);

        return redirect("/raffles/$raffle->id/add-prizes");
    }
}
