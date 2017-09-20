<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ArticleRequest;
use App\Repositories\Contracts\ArticleRepositoryInterface;

class ArticleController extends Controller
{
    /**
     * ArticleRepositoryInterface
     *
     * @var object
     */
    private $articleRepository;

    /**
     * Create a new controller instance.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @return void
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the article.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = $this->articleRepository->all()->sortByDesc('id');

        return response()->json($articles, Response::HTTP_OK);
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  App\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $article = $this->articleRepository->create($request->all());

        return response()->json($article, Response::HTTP_CREATED);
    }

    /**
     * Display the specified article.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = $this->articleRepository->findBySlug($slug, ['tags', 'categories']);

        return view('pages.article')->with(compact('article'));
    }

    /**
     * Display the specified article for update.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $article = $this->articleRepository->findWith($id, ['tags', 'categories']);

        return response()->json($article, Response::HTTP_OK);
    }

    /**
     * Update the specified article in storage.
     *
     * @param  App\Http\Requests\ArticleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = $this->articleRepository->find($id);

        $this->articleRepository->update($article, $request->all());

        return response()->json($article, Response::HTTP_OK);
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->find($id);

        $this->articleRepository->delete($article);

        return response()->json(null, Response::HTTP_OK);
    }
}
