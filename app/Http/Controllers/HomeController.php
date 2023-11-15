<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Role_User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index():View{
        $user = auth()->user();
        $userRole =Role_User::where('user_id','=',$user->id)->first();
        $role = Role::find($userRole->role_id);
        if($role->role ==='admin'){
            return View('dashboard');
        }else if($role->role ==='étudiant'){
            return View('dashboard');

        }else if($role->role ==='enseignant'){
            return View('dashboard');

        }else if($role->role ==='parent'){
            return View('dashboard');

        }

    }
}
