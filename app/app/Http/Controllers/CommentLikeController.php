<?php

namespace App\Http\Controllers;

use App\Repositories\CommentLike\CommentLikeRepositoryInterface;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function __construct(CommentLikeRepositoryInterface $comment_like_repository)
    {
        $this->comment_like_repository = $comment_like_repository;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $article
     * @return \Illuminate\Http\Response
     */
    public function store($article, Request $request)
    {
        return $this->comment_like_repository->store($article, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $artilcle
     * @return \Illuminate\Http\Response
     */
    public function destroy($article, $comment_like)
    {
        return $this->comment_like_repository->destroy($article, $comment_like);
    }
}
