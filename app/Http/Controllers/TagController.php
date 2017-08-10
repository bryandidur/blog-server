<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TagRequest;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagController extends Controller
{
    /**
     * TagRepositoryInterface
     *
     * @var object
     */
    private $tagRepository;

    /**
     * Create a new controller instance.
     *
     * @param TagRepositoryInterface $tagRepository
     * @return void
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the tag.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tags = $this->tagRepository->all()->sortByDesc('id');

        return response()->json($tags, Response::HTTP_OK);
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        $tag = $this->tagRepository->create($request->all());

        return response($tag, Response::HTTP_CREATED);
    }

    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tag = $this->tagRepository->find($id);

        return response()->json($tag, Response::HTTP_OK);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  App\Http\Requests\TagRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagRequest $request, $id)
    {
        $tag = $this->tagRepository->find($id);

        $this->tagRepository->update($tag, $request->all());

        return response()->json($tag, Response::HTTP_OK);
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $tag = $this->tagRepository->find($id);

        $this->tagRepository->delete($tag);

        return response()->json(null, Response::HTTP_OK);
    }
}
