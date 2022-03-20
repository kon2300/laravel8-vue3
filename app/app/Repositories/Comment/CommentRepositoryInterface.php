<?php

namespace App\Repositories\Comment;

interface CommentRepositoryInterface
{
  function store($article, Request $request);

  function destroy($article, $comment);
}