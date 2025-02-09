<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthanticationController extends Controller
{
    use ValidatesRequests;

    public function index(Request $request)
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $remember_me)) {
            return response()->json([
                'status' => true,
                'message' => 'Authentication Success',
                'redirect_location' => route('dashboard'),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Username or password incorrect',
            ],401,);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}