<?php

namespace App\Repositories\Follow;

interface FollowRepositoryInterface
{
  function store($article, Request $request);

  function destroy($article, $favorite);
}