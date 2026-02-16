<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * 🕵️‍♂️ The Bouncer (Admin Middleware)
 * 
 * This file acts like a security guard at a VIP club entrance.
 * It checks every request that tries to enter a restricted area.
 * - If you have the "Admin Badge" (isAdmin() returns true), you pass.
 * - If you don't, you are politely escorted back to the home page.
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 1. Get the current user
        /** @var \App\User|null $user */
        $user = Auth::user();

        // 2. Check the badge
        // "Are you logged in?" AND "Is your role Admin?"
        if ($user && $user->isAdmin()) {
            // ✅ Access Granted: Pass the request to the next step (the Controller)
            return $next($request);
        }

        // ⛔ Access Denied: Send them away
        return redirect('/')->with('error', 'Unauthorized access. Only administrators can perform this action.');
    }
}
