<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ArticleRequest;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class ArticleController extends Controller
{
    /**
     * TagRepositoryInterface
     *
     * @var object
     */
    private $tagRepository;

    /**
     * CategoryRepositoryInterface
     *
     * @var object
     */
    private $categoryRepository;

    /**
     * ArticleRepositoryInterface
     *
     * @var object
     */
    private $articleRepository;

    /**
     * Create a new controller instance.
     *
     * @param TagRepositoryInterface $tagRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ArticleRepositoryInterface $articleRepository
     * @return void
     */
    public function __construct(
        TagRepositoryInterface $tagRepository,
        CategoryRepositoryInterface $categoryRepository,
        ArticleRepositoryInterface $articleRepository
    )
    {
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
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
     * Show data for creating a new article.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $tags = $this->tagRepository->all()->sortByDesc('id');
        $categories = $this->categoryRepository->all()->sortByDesc('id');

        return response()->json(compact('tags', 'categories'), Response::HTTP_OK);
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
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
    }

    /**
     * Show data for editing the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $article = $this->articleRepository->findWith($id, ['tags', 'categories']);

        $tags = $this->tagRepository->all()->sortByDesc('id');
        $categories = $this->categoryRepository->all()->sortByDesc('id');

        return response()->json(compact('article', 'tags', 'categories'), Response::HTTP_OK);
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
