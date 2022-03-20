<?php

namespace App\Repositories\Article;

interface ArticleRepositoryInterface
{
  function index();

  function create();

  function store(Request $request);

  function show($article);

  function edit($article);

  function update(Request $request, $article);

  function destroy($article);
}