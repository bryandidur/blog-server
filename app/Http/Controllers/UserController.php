<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userRepository->all()->sortByDesc('id');

        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create($request->all());

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Display the specified user for update.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->find($id);

        $this->userRepository->update($user, $request->all());

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        $this->userRepository->delete($user);

        return response()->json(null, Response::HTTP_OK);
    }
}
