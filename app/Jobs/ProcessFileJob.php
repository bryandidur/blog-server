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
     * File data to be proccessed.
     *
     * @var array
     */
    public $fileData;

    /**
     * Directory where file will be stored.
     *
     * @var string
     */
    public $fileDirectory = 'public';

    /**
     * File visibility.
     *
     * @var string
     */
    public $fileVisibility = 'public';

    /**
     * Create a new job instance.
     *
     * @param  array  $file
     * @return void
     */
    public function __construct(array $fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FileRepository $fileRepository)
    {
        $data = [
            'user_id'    => $this->fileData['user_id'],
            'disk'       => $this->fileData['disk'],
            'name'       => $this->fileData['name'],
            'mime'       => $this->fileData['mime'],
            'extension'  => $this->fileData['extension'],
            'path'       => $this->fileDirectory . '/' . str_random(30) . '.' . $this->fileData['extension'],
        ];

        \Storage::disk($data['disk'])->put($data['path'], base64_decode($this->fileData['contents']), $this->fileVisibility);

        return $fileRepository->create($data);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        //
    }
}
