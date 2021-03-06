<?php

namespace App\Http\Controllers;

use App\Repositories\Favorite\FavoriteRepositoryInterface;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct(FavoriteRepositoryInterface $favorite_repository)
    {
        $this->favorite_repository = $favorite_repository;
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
        return $this->favorite_repository->store($request, $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article, $favorite)
    {
       return $this->favorite_repository->destroy($article, $favorite);
    }
}
