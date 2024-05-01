<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
class UserController extends Controller
{
    //

    //login view
    public function LoginPage()
    {
    
        return view('auth.login');
        
    }

    //login request
    public function Login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {

            $user = Auth::user();


            if ($user->is_active) {
                return redirect()->route('dashbord.index');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors([
                    "login" => "Your account is inactive. Please contact support."
                ]);
            }
        } else {
            // Authentication failed
            return back()->withErrors(['message' => 'Invalid username or password.']);
        }

    
        
    }

    //users list
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

    //used to register new user
    public function Register(Request $request)
    {


    }

    //used to change state of user actived or disactived
    public function ChangeStatus($id)
    {

        dd($id);
        $user=User::find($id);
        $user->setAttribute("is_active", !$user->getAttributeValue("is_active"));
        $user->save();
        return redirect()->back();
        
    }

}
