<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users=User::get();
        if(!$request->ajax())
        return view();

        return response ()->json(['status'=>$users],201);

    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {
      $user = new User ($request->all());
      $user->save();
      if(!$request->ajax())
        return back()->with('succes','User created');

        return response()->json(['status'=>'User created','user'=>$user],201);

    }

    public function show(Request $request ,User $user)
    {
   

        if(!$request->ajax())
        return view();

        return response ()->json(['user'=>$user],200);
    }

    public function edit($id)
    {
        //
    }


    public function update(UserRequest $request, User $user)
    {
      $user->update($request->all());
      if(!$request->ajax())
        return back()->with('succes','User Update');

        return response()->json([],204);
    }


    public function destroy(Request $request,User $user)
    {
        $user->delete();
        if(!$request->ajax())
        return back()->with('succes','User Delete');

        return response()->json([],204);
    }
}
