<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * CategoryRepositoryInterface
     *
     * @var object
     */
    private $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = $this->categoryRepository->all()->sortByDesc('id');

        return response()->json($categories, Response::HTTP_OK);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->all());

        return response()->json($category, Response::HTTP_CREATED);
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->find($id);

        $this->categoryRepository->update($category, $request->all());

        return response()->json($category, Response::HTTP_OK);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        $this->categoryRepository->delete($category);

        return response()->json(null, Response::HTTP_OK);
    }
}
