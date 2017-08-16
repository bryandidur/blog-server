<?php

namespace App\Http\Controllers;

use Storage;
use App\Jobs\ProcessFileJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\FileRequest;
use App\Repositories\Contracts\FileRepositoryInterface;

class FileController extends Controller
{
    /**
     * FileRepositoryInterface
     *
     * @var object
     */
    private $fileRepository;

    /**
     * Create a new controller instance.
     *
     * @param FileRepositoryInterface $fileRepository
     * @return void
     */
    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the file.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $files = $this->fileRepository->all()->sortByDesc('id');

        $files->transform(function ($file, $key) {
            $file->url = Storage::disk($file->disk)->url($file->path);
            return $file;
        });

        return response()->json($files, Response::HTTP_OK);
    }

    /**
     * Store a newly created file in storage.
     *
     * @param  App\Http\Requests\FileRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileRequest $request)
    {
        $files = collect($request->file('files'));

        $files->map(function ($file, $key) use ($request) {
            $eventJob = new ProcessFileJob([
                'user_id'   => auth()->user()->id,
                'disk'      => $request->get('disk'),
                'name'      => strchr($file->getClientOriginalName(), '.', true),
                'mime'      => $file->getMimetype(),
                'extension' => $file->getClientOriginalExtension(),
                'contents'  => base64_encode(file_get_contents($file->getPathname())),
            ]);

            dispatch($eventJob->onQueue('uploads'));
        });

        return response()->json(['success' => true], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $file = $this->fileRepository->find($id);
        $file->url = Storage::disk($file->disk)->url($file->path);

        return response()->json($file, Response::HTTP_OK);
    }

    /**
     * Update the specified file in storage.
     *
     * @param  App\Http\Requests\FileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FileRequest $request, $id)
    {
        $file = $this->fileRepository->find($id);

        $this->fileRepository->update($file, $request->all());

        $file->url = Storage::disk($file->disk)->url($file->path);

        return response()->json($file, Response::HTTP_OK);
    }

    /**
     * Remove the specified file from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $file = $this->fileRepository->find($id);

        $this->fileRepository->delete($file);
        Storage::disk($file->disk)->delete($file->path);

        return response()->json(null, Response::HTTP_OK);
    }

    /**
     * Remove bulk files from storage.
     *
     * @param  App\Http\Requests\FileRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDestroy(FileRequest $request)
    {
        $files = $this->fileRepository->findMany($request->get('ids'));
        $filePaths = $files->groupBy('disk');

        foreach ($filePaths as $disk => $paths) {
            $paths = $paths->pluck('path')->toArray();

            Storage::disk($disk)->delete($paths);
        }

        $this->fileRepository->bulkDelete($files);

        return response()->json(null, Response::HTTP_OK);
    }
}
