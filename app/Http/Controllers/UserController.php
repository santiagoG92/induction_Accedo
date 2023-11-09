<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\User\UserRequest;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users=User::get();
        if (!$request->ajax()) return view('users.index', compact('users'));

        return response ()->json(['users'=>$users],200);

    }
   

    public function create()
    {
       return view('users.create');
    }

    public function store(UserRequest $request)
    {
      $user = new User ($request->all());
      $user->save();
      if(!$request->ajax())
        return back()->with('success','User created');

        return response()->json(['status'=>'User created','user'=>$user],201);

    }

    public function show(Request $request ,User $user)
    {
   

        if(!$request->ajax())
        return view();

        return response ()->json(['user'=>$user],200);
    }

    public function edit(User $user)
    {
        return view('users.edit' , compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
      $user->update($request->all());
      if(!$request->ajax())
        return back()->with('success','User Update');

        return response()->json([],204);
    }


    public function destroy(Request $request,User $user)
    {
        $user->delete();
        if(!$request->ajax())
        return back()->with('success','User Delete');

        return response()->json([],204);
    }
}
