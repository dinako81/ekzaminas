<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $roles = explode('|', $roles);
        // paverciam roles i masyva (1, 10-kokie gali buti useriai)
        
        $userRole = User::ROLES[$user->role];
        // is user modelio ROLES masyvo

        // issifruojam userio role

        if (!in_array($userRole, $roles)) {
            abort(401);
        }

        // jeigu userio roles nera roles masyve, nes jo isleisti negalime
        
        // dump($roles);
        // dump($userRole);
        
        return $next($request);
    }
}