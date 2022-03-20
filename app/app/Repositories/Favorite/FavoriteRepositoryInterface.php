<?php

namespace App\Repositories\Favorite;

interface FavoriteRepositoryInterface
{
  function store($article, Request $request);

  function destroy($article, $favorite);
}