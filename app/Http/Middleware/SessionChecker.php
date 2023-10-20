<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade

class SessionChecker
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user_id') && $request->session()->has('user_name')) {
            $userId = $request->session()->get('user_id');
            $userName = $request->session()->get('user_name');
            $user = DB::table('m_users')
                ->where('userID', $userId)
                ->where('username', $userName)
                ->first();

            if ($user) {
                return $next($request);
            }
        }

        return redirect()->route('welcome');
    }
}
