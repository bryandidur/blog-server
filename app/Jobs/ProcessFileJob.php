<?php

namespace App\Jobs;

use App\Repositories\FileRepository;
use Illuminate\Support\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Data to be proccessed
     *
     * @var \Illuminate\Support\Collection
     */
    public $files;

    /**
     * Directory where files will be stored.
     *
     * @var string
     */
    public $filesDirectory = 'public';

    /**
     * Files visibility.
     *
     * @var string
     */
    public $filesVisibility = 'public';

    /**
     * Create a new job instance.
     *
     * @param  \Illuminate\Support\Collection  $files
     * @return void
     */
    public function __construct(Collection $files)
    {
        $this->files = $files;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FileRepository $fileRepository)
    {
        $this->files->transform(function ($file, $key) {
            $path = $this->filesDirectory . '/' . str_random(30) . '.' . $file['extension'];

            \Storage::disk($file['disk'])->put($path, base64_decode($file['contents']), $this->filesVisibility);

            return [
                'user_id'    => $file['user_id'],
                'disk'       => $file['disk'],
                'name'       => $file['name'],
                'mime'       => $file['mime'],
                'extension'  => $file['extension'],
                'path'       => $path,
            ];
        });

        return $fileRepository->bulkCreate($this->files->toArray());
    }
}
