<?php

namespace App\Http\Middleware;

use App\Models\Raffle;
use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $raffle = $request->route('raffle');

        $user = auth()->user();

        if($raffle->user_id === $user->id) {
            return $next($request);
        }

        return redirect('/home')->withErrors(['GeneralErrors'=>'Sorry, you cannot access this raffle event because you are not the owner.']);
    }
}
