<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ArticleRepositoryInterface as ArticleRepository;

class HomeController extends Controller
{
    /**
     * The article repository implementation.
     *
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    /**
     * Create a new controller instance.
     *
     * @param ArticleRepositoryInterface $articleRepository
     * @return void
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->all(5, true);

        return view('pages.home')->with(compact('articles'));
    }
}
