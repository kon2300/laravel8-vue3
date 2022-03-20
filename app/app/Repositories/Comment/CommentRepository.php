<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
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
        $request->validate([
            'content' => ['required']
        ]);

        $input = $request->only("content");
        $input['user_id'] = Auth::id();
        $input['article_id'] = $article;
        Comment::create($input);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article, $comment)
    {
        Comment::find($comment)->delete();

        return back();
    }
}
