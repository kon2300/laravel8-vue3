<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $article)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['article_id'] = $article;
        Favorite::create($input);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article, Favorite $favorite)
    {
        $favorite->delete();

        return back();
    }
}
