<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::latest()->get();
        // dd($users);
        return view('dashbord.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('dashbord.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => ['required', 'confirmed'],

        ]);



        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'=>$request->userrole,
        ]);

        event(new Registered($user));

        return redirect()->route('dashbord.users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user=User::find($id);
        return view('dashbord.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',

        ]);
        $id=$request->id;
        $user = User::find($id);
        $user->name= $request->name;
        $user->username= $request->username;
        if ($user->role !="superadmin") {
            $user->role=$request->userrole;
        }


        $user->save();

        return  redirect()->route('dashbord.users');
    }
    public function updatepassword(Request $request)
    {
        //
        $request->validate([
          
            'password' => ['required', 'confirmed'],

        ]);
        $id=$request->id;
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return  redirect()->back();
    }

    public function change_activation_status($id)
    {
        $user=User::find($id);
        if ($user->role!=="superadmin") {
            $user->setAttribute("is_active", !$user->getAttributeValue("is_active"));
            $user->save();
            return redirect()->back();
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
