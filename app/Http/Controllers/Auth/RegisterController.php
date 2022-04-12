<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterValidationRequest;


class RegisterController extends Controller
{
    public function __Construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterValidationRequest $request)
    {
        //store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //sign the user in
        auth()->attempt($request->only('email', 'password'));

        //redirect
        return redirect()->route('dashboard');
    }
}
