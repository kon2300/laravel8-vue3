<?php

namespace App\Repositories\CommentLike;

interface CommentLikeRepositoryInterface
{
  function store($article, Request $request);

  function destroy($article, $comment_like);
}