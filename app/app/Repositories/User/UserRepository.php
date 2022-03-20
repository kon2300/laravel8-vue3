<?php

namespace App\Repositories\User;

use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
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
}