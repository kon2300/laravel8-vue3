<?php

namespace App\Http\Controllers;

use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $users = User::with('followers', 'followings')->where('id', $user)->first();
        $followers = FollowUser::where('following_user_id', $user)->with('followings')->get();
        $followings = FollowUser::where('user_id', $user)->with('followers')->get();

        return Inertia::render('Dashboard', ['user' => $users, 'followers' => $followers, 'followings' => $followings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        if (Auth::id() === (int)$user) {
            return Redirect::route('users.index');
        };

        $users = User::with('followers', 'followings')->where('id', $user)->first();
        $followers = FollowUser::where('following_user_id', $user)->with('followings')->get();
        $followings = FollowUser::where('user_id', $user)->with('followers')->get();
        $checkFollow = FollowUser::where('user_id', Auth::id())->Where('following_user_id', $user)->get();
        return Inertia::render('User/Show', ['users' => $users, 'followers' => $followers, 'followings' => $followings, 'checkFollow' => $checkFollow]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

