<?php

namespace App\Repositories\Favorite;

use App\Models\Favorite;
use App\Repositories\Favorite\FavoriteRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $article
     * @return \Illuminate\Http\Response
     */
    public function store($request, $article)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['article_id'] = $article;
        Favorite::create($input);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article, $favorite)
    {
        Favorite::find($favorite)->delete();

        return back();
    }
}
