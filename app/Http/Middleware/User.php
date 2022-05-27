<?php

namespace App\Http\Middleware;

use App\Models\User as UserModel;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        
        if (Auth::check()){
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
            UserModel::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }

        if (!Auth::guard('user')->check()){
            return redirect()->route('login');
        }

        return $next($request);
    }
}
