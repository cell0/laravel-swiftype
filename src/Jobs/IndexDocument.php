<?php

namespace Loonpwn\Swiftype\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Loonpwn\Swiftype\Facades\SwiftypeEngine;

class IndexDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $document;

    /**
     * Create a new job instance.
     *
     * @param $document
     */
    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app(SwiftypeEngine::class)->indexDocument($this->document);
    }
}
