<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function create() {
        return inertia('raffles.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'string|required',
            'description'=>'string'
        ]);

        Raffle::create([
            'name' => $request->name,
            'description'=> $request->description,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/home')->with('Message','New raffle has been created.');
    }
}
