<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class  UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if($user){
            $user->delete();
        }

        return redirect()->route('user.index');
    }

    public function roles($user)
    {
        $user = User::where('id', $user)->first();

        $roles = Role::all();

        foreach ($roles as $role) {
            if ($user->hasRole($role->name)) {
                $role->can = true;
            } else {
                $role->can = false;
            }
        }

        return view('users.roles', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function sync(Request $request, $user)
    {
        $assignedRoles = $request->except(['_token', '_method']);

        foreach ($assignedRoles as $key => $value) {
            $roles[] = Role::where('id', $key)->first();
        }

        $user = User::where('id', $user)->first();

        if (!empty($roles)) {
            $user->syncRoles($roles);
        } else {
            $user->syncRoles(null);
        }

        return redirect()->route('user.roles', ['user' => $user->id]);
    }

}
