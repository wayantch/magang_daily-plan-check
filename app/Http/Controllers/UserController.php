<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10); // scalable
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
    
    }
}
