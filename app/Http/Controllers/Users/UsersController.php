<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){

        $profile = User::find(Auth::user()->id);

        return view('users.profile', compact('profile'));
    }
}
