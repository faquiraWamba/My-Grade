<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class is_adminstudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user=auth()->user();
        $user=User::with('roles')->find($user->id);
        $user_roles = $user->roles;
        foreach($user_roles as $user_role){
            $role=Role::find($user_role->role_id);
            if($role->role==='admin' || $role->role==='étudiant'){
                return $next($request);
            }
            return redirect('home')->with('error',"Vous n\'avez pas les accès d\'un administrateur ou d'un étudiant");
            break;
        }
    }
}
