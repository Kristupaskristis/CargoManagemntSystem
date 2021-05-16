<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::all();
        return view('auth.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(['name', 'display_name']);

        return view('auth.users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|exists:roles,name',
            'name'     => 'required',
            'surname'     => 'required',
            'company'     => 'required',
            'position'     => 'required',
            'phone_number'     => 'required',
        ]);

        $user = User::create([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $info = new UserInfo([
           'user_id' => $user->id,
           'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'company' => $request->get('company'),
            'position' => $request->get('position'),
            'phone_number' => $request->get('phone_number')
        ]);
        $info->save();


        $user->assignRole($request->role);
        return redirect('/users')->with('success', 'Vartotojas pridėtas!');
    }

    public function delete()
    {
    }

    public function edit()
    {
    }
}
