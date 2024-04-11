<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlastJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduled_at;
    public function __construct()
    {
        $this->scheduled_at = now()->addMinutes(2);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (now() == $this->scheduled_at) {
            info('BlastJob is running on ' . $this->scheduled_at);
        }
    }
}
