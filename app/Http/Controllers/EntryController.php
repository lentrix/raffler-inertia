<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Raffle;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index(Raffle $raffle) {
        $raffle->load('entries');
        return inertia('entries.index', [
            'raffle' => $raffle
        ]);
    }

    public function store(Raffle $raffle, Request $request) {
        $request->validate([
            'name'=>'string|required',
            'description'=>'string|required',
        ]);

        Entry::create([
            'raffle_id' => $raffle->id,
            'ticket_no' => $request->ticket_no ? $request->ticket_no : rand(1,999999999),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect("/raffles/$raffle->id/entries");
    }

    public function destroy(Entry $entry) {
        $entry->delete();
        return back();
    }
}
