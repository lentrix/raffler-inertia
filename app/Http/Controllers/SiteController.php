<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function loginForm() {
        return inertia('login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'string|required',
            'password' => 'string|required',
        ]);

        $login = auth()->attempt([
            'username' => $request->username,
            'password' => $request->password
        ]);

        if($login) {
            return redirect('/home');
        }

        return back()->withErrors(['authentication'=>'Invalid username/password']);
    }

    public function home() {
        $raffles = Raffle::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get()->map(function($raffle, $key){
            return [
                'id' => $raffle->id,
                'name' => $raffle->name,
                'description' => $raffle->description,
                'prizes' => $raffle->prizes->count(),
                'entries' => $raffle->entries->count(),
                'draws' => $raffle->draws->count(),
            ];
        });

        return inertia('home', [
            'raffles' => $raffles
        ]);
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
