<?php

namespace App\Repositories\Follow;

use App\Models\FollowUser;
use App\Repositories\Follow\FollowRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FollowRepository implements FollowRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $user
     * @return \Illuminate\Http\Response
     */
    public function store($user, $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['following_user_id'] = $user;
        FollowUser::create($input);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, $follow)
    {
        FollowUser::find($follow)->delete();

        return back();
    }
}
