<?php

namespace App\Repositories\CommentLike;

use App\Models\CommentLike;
use App\Repositories\CommentLike\CommentLikeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentLikeRepository implements CommentLikeRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $article
     * @return \Illuminate\Http\Response
     */
    public function store($article, $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['comment_id'] = $article;
        CommentLike::create($input);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $artilcle
     * @return \Illuminate\Http\Response
     */
    public function destroy($artilcle, $comment_like)
    {
        CommentLike::find($comment_like)->delete();

        return back();
    }
}
