<?php

namespace App\Http\Controllers;

use App\Models\Draw;
use App\Models\Entry;
use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function create()
    {
        return inertia('raffles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string'
        ]);

        Raffle::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/home')->with('Message', 'New raffle has been created.');
    }

    public function show(Raffle $raffle)
    {
        $entries = Entry::where('raffle_id', $raffle->id);
        $entries_count = $entries->count();

        return inertia('raffles.show', [
            'raffle' => $raffle,
            'prizes' => $raffle->prizes,
            'entries_count' => $entries_count,
            'entries' => $entries->limit(30)->get(),
            'draws' => $raffle->draws
        ]);
    }

    public function drawPage(Raffle $raffle)
    {
        $raffle->load('prizes');
        $raffle->load('entries');

        return inertia('raffles.draw', [
            'raffle' => $raffle,
            'draws' => $raffle->draws,
            'non_winners' => $raffle->nonWinners
        ]);
    }

    public function draw(Raffle $raffle, Request $request)
    {

        Draw::create([
            'entry_id' => $request->entry_id,
            'prize_id' => $request->prize_id
        ]);

        return back();
    }
}
