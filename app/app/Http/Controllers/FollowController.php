<?php

namespace App\Http\Controllers;

use App\Repositories\Follow\FollowRepositoryInterface;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct(FollowRepositoryInterface $follow_repository)
    {
        $this->follow_repository = $follow_repository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $user
     * @return \Illuminate\Http\Response
     */
    public function store($user, Request $request)
    {
        return $this->follow_repository->store($user, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, $follow)
    {
        return $this->follow_repository->destroy($user, $follow);
    }
}
