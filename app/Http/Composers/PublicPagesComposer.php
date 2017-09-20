<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\Contracts\TagRepositoryInterface as TagRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepository;

class PublicPagesComposer
{
    /**
     * The tag repository implementation.
     *
     * @var TagRepositoryInterface
     */
    private $tagRepository;

    /**
     * The category repository implementation.
     *
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * Create a new profile composer.
     *
     * @param TagRepositoryInterface $tagRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @return void
     */
    public function __construct(TagRepository $tagRepository, CategoryRepository $categoryRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $composer = (object) [
            'tags' => $this->tagRepository->all(),
            'categories' => $this->categoryRepository->all(),
        ];

        $view->with(compact('composer'));
    }
}
