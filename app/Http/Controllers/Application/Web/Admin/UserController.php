<?php

namespace App\Http\Controllers\Application\Web\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = new User();

        if(!empty($request->first_name)){
            $users = $users->where('first_name', 'LIKE', '%'.$request->first_name.'%');
        }

        if(!empty($request->last_name)){
            $users = $users->where('last_name', 'LIKE', '%'.$request->last_name.'%');
        }

        if(!empty($request->username)){
            $users = $users->where('username', 'LIKE', '%'.$request->username.'%');
        }

        $users = $users->paginate(20);

        return view('admin.users.index',[
            'users' => $users,
            'search_terms' => [
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'roles' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|max:32|confirmed',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->roles = $request->roles;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admins.users.index')->with('success_message','Succesfully Create User');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.show',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'roles' => 'required',
            'username' => 'required|unique:users',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->roles = $request->roles;
        
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admins.users.index')->with('success_message','Succesfully Update User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admins.users.index')->with('success_message','Succesfully Delete User');
    }
}
