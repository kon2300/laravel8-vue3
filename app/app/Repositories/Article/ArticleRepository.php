<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Repositories\Article\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user', 'comments.commentLikes', 'favorites', 'Tags')->get();
        return Inertia::render('Article/Index', ['articles' => $articles, 'users' => Auth::id()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        $input = $request->only(["title", "content"]);
        $input['user_id'] = Auth::id();
        Article::create($input);
        return Redirect::route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function show($article)
    {
        $article = Article::with('user', 'comments.user', 'comments.commentLikes', 'favorites', 'Tags')->where('id', $article)->first();
        return Inertia::render('Article/Show', ['article' => $article, 'users' => Auth::id()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article)
    {
        $article = Article::find($article);
        return Inertia::render('Article/Edit', ['articles' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function update($request, $article)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        $input = $request->only(["title", "content"]);

        Article::find($article)->update($input);

        return Redirect::route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article)
    {
        Article::find($article)->delete();
        return Redirect::route('articles.index');
    }
}
