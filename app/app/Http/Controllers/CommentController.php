<?php

namespace App\Http\Controllers;

use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function __construct(CommentRepositoryInterface $comment_repository)
    {
        $this->comment_repository = $comment_repository;
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
        return $this->comment_repository->store($article, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article, $comment)
    {
        return $this->comment_repository->destroy($article, $comment);
    }
}
